<?php

  // TODO
  // Lieder suchen, erfassen, bearbeiten
  // Ablauf
  //  - PDF-Erstellung
  // Rechte implementieren
  //  - Bearbeitungszeitpunkte (nach Godi nicht mehr änderbar
  //  - Links in Kalender
  //  - Rechteprüfungen beim Öffnen und Speichern
  // Cron mit Infomails implementieren


  // DONE
  // Login-Bereich
  //  - Frontend mit sortable


  namespace BB\custom\extension\efgettenheim {

    use BB\custom\extension\efgettenheim\lib\classes\agendaPdf;

    if(@secure !== true)
      die('forbidden');

    class engine extends \BB\engine\common {

      protected $path = 'custom/extension/efgettenheim/';

      protected $error = false;
      protected $sent = false;
      protected $captchaSuccess = false;

      /**
       *
       */
      public function viewCalendar(){
        $startTimestamp = time();
        $dayAsTimestamp = 24*60*60;
        $endTimestamp = $startTimestamp + 365*$dayAsTimestamp;
        $calendarEvents = [];
        for($currentTimestamp = $startTimestamp; $currentTimestamp <= $endTimestamp; $currentTimestamp += $dayAsTimestamp):
          $currentWeekDay = strftime('%w', $currentTimestamp);
          if(0 == $currentWeekDay):
            $calendarEvents[] = [
              'title' => 'Gottesdienst',
              'start' => strftime("%Y-%m-%d 10:00", $currentTimestamp)
            ];
          endif;
        endfor;

        $calendarEventsEncoded = json_encode($calendarEvents);

        if($this->mode == 'edit') $calendarEventsEncoded = '';

        $this->view
          ->assign('calendarEvents', $calendarEventsEncoded)
          ->assign('calendarEventsEditPage', $this->getLink($this->values['pageEditEvent']['cnv_value'], true))
          ->assign('h1', $this->values['h1']['cnv_value'])
          ->assign('h2', $this->values['h2']['cnv_value'])
        ;

      }

      /**
       *
       */
      public function viewSermons(){

        $serviceRows = $this->getServiceRowsForSermons();


        foreach($serviceRows as $serviceRow):
          $staffID = $serviceRow->servicePreacher;
          $serviceRow->servicePreacher = $this->getStaffFullName($staffID);
        endforeach;

        $this->view
          ->add('serviceRows', $serviceRows)
          ->assign('h1', $this->values['h1']['cnv_value'])
          ->assign('h2', $this->values['h2']['cnv_value'])
        ;

      }

      /**
       * @param int $staffID
       * @return string
       */
      private function getStaffFullName($staffID) {

        $staffFactory = \BB\custom\extension\efgettenheim\access\factory\staff::get();
        $staffRow = $staffFactory->getRow($staffID);
        return $staffRow->staffFirstname.' '.$staffRow->staffLastname;
      }

      /**
       *
       */
      private function searchSong() {

        $bbRequest = \BB\request\http::get();
        $searchTerm = $bbRequest->getString('q');

        $songBooksIDsAsNames = $this->getSongBookIDsAsNames();

        $songSearch = new \BB\custom\extension\efgettenheim\lib\search\songSearch($searchTerm);
        $songFactory = \BB\custom\extension\efgettenheim\access\factory\song::get();
        $searchResults = $songFactory->searchRows($songSearch, true);

        $results = [];
        foreach($searchResults as $searchResult):
          $resultItem = new \stdClass();
          $resultItem->id = $searchResult->getContentID();
          $resultItem->text = $searchResult->songTitle.' ('.$songBooksIDsAsNames[$searchResult->songBook].', '.$searchResult->songNumber.')';
          $results[] = $resultItem;
        endforeach;

        $response = [
          'results' => $results
        ];

        $this->json($response);

      }

      /**
       * @return array
       */
      private function getSongBookIDsAsNames() {
        $songBookSearch = new \BB\custom\extension\efgettenheim\lib\search\songBookSearch($searchTerm);
        $songBookFactory = \BB\custom\extension\efgettenheim\access\factory\songBook::get();
        $songBookRows = $songBookFactory->searchRows($songBookSearch, true);

        $songBooksIDsAsNames = [];
        foreach($songBookRows as $songBookRow):
          $songBooksIDsAsNames[$songBookRow->getContentID()] = $songBookRow->songBookTitle;
        endforeach;

        return $songBooksIDsAsNames;
      }

      /**
       *
       */
      public function viewEditEvent(){

        $bbRequest = \BB\request\http::get();
        $eventTimestamp = $bbRequest->getString('eventTimestamp');
        $editMode = $bbRequest->getString('mode');
        $searchSong = $bbRequest->getBoolean('searchSong');

        if($searchSong):
          $this->searchSong();
        endif;

        $serviceRow = $this->getServiceRowByEventTimestamp($eventTimestamp);
        $serviceSongBridge = \BB\custom\extension\efgettenheim\access\bridge\serviceSong::get();
        $serviceAgendaBridge = \BB\custom\extension\efgettenheim\access\bridge\serviceAgenda::get();
        $songs = $serviceSongBridge->getSongRows($serviceRow->getContentID());
        $agenda = $serviceAgendaBridge->getAgendaRows($serviceRow->getContentID());

        $modelField = \BB\model\field::get();

        $formFieldIdentifiers = $this->getAllowedFormFieldIdentifiers($editMode);

        foreach($formFieldIdentifiers as $formFieldIdentifier):

          $formFieldField = $modelField->getField($formFieldIdentifier);
          $formFieldValue = $serviceRow->{$formFieldIdentifier};

          $options = [
            'languageID' => 1,
            'fieldName' => $formFieldIdentifier,
            'fieldValue' => $formFieldValue,
            'field' => $formFieldField,
            'userID' => 0
          ];

          $formField = \BB\model\formField::instance($options);

          $this->view
            ->add('formField'.ucfirst($formFieldIdentifier), $formField->getField());

        endforeach;

        $songBooksIDsAsNames = $this->getSongBookIDsAsNames();
        foreach($songs as $song):
          $song->songTitle = $song->songTitle.' ('.$songBooksIDsAsNames[$song->songBook].', '.$song->songNumber.')';
        endforeach;

        $this->view
          ->add('eventTimestamp', $eventTimestamp)
          ->add('editMode', $editMode)
          ->add('songs', $songs)
          ->add('agenda', $agenda)
          ->add('sermonTopic', $serviceRow->serviceSermonTopic)
          ->add('preacherName', $this->getStaffFullName($serviceRow->servicePreacher))
          ->add('moderatorName', $this->getStaffFullName($serviceRow->serviceModerator))
          ->assign('calendarPage', $this->getLink($this->values['pageCalendar']['cnv_value'], true))
          ->assign('eventID', $serviceRow->getContentID())
        ;

      }



      /**
       * @param string $editMode
       * @return array
       */
      private function getAllowedFormFieldIdentifiers($editMode) {

        switch($editMode):

          case 'agenda':
            break;

          case 'sermonTopic':
            $formFieldIdentifiers = [
              'serviceSermonTopic'
            ];
            break;

          case 'songs':
            $formFieldIdentifiers = [];
            break;

          default:

            $formFieldIdentifiers = $this->getFormFieldsByRight();
            break;

        endswitch;

        return $formFieldIdentifiers;
      }

      /**
       * @return array
       */
      private function getFormFieldsByRight() {

        $rights = $this->getRights();
        $formFieldIdentifiers = [];

        if($rights->hasRightToManageModerators()):
          $formFieldIdentifiers[] = 'serviceModerator';
        endif;

        if($rights->hasRightToManagePreachers()):
          $formFieldIdentifiers[] = 'servicePreacher';
        endif;

        if($rights->hasRightToManageWorship()):
          $formFieldIdentifiers[] = 'serviceWorshipLeader';
          $formFieldIdentifiers[] = 'serviceWorshipMusicians';
        endif;

        if($rights->hasRightToManageAudioEngineers()):
          $formFieldIdentifiers[] = 'serviceAudioEngineer';
        endif;

        if($rights->hasRightToManageSundaySchool()):
          $formFieldIdentifiers[] = 'serviceSundaySchoolTeacherSmall';
          $formFieldIdentifiers[] = 'serviceSundaySchoolTeacherBig';
        endif;

        if($rights->hasRightToManageReception()):
          $formFieldIdentifiers[] = 'serviceReceptionist';
        endif;

        return $formFieldIdentifiers;

      }

      /**
       * @return lib\classes\rights
       */
      private function getRights() {

        $session = \BB\request\session::get();
        $userID = $session->getByPath('user/userID');

        $rights = \BB\custom\extension\efgettenheim\lib\classes\rights::get($userID);

        return $rights;
      }

      /**
       * @return array
       */
      private function isMultiSelect($checkIdentifier) {

        return in_array($checkIdentifier, ['serviceWorshipMusicians']);
      }

      /**
       * @return access\object\service|mixed
       */
      private function getServiceRowsForSermons() {

        $serviceSearch = new \BB\custom\extension\efgettenheim\lib\search\sermonSearch(time());
        $serviceFactory = \BB\custom\extension\efgettenheim\access\factory\service::get();
        $results = $serviceFactory->searchRows($serviceSearch, true);

        return $results;
      }

      /**
       * @param string $eventTimestamp
       * @return access\object\service|mixed
       */
      private function getServiceRowByEventTimestamp($eventTimestamp) {

        $serviceSearch = new \BB\custom\extension\efgettenheim\lib\search\eventSearch($eventTimestamp);
        $serviceFactory = \BB\custom\extension\efgettenheim\access\factory\service::get();
        $results = $serviceFactory->searchRows($serviceSearch, true);
        $serviceRow = current($results);

        if(empty($serviceRow)):
          $serviceRow = $serviceFactory->getRow(0);
          $serviceRow->serviceDate = $eventTimestamp;
          $serviceRow->serviceLabel = strftime('%A, den %d.%m.%Y', $eventTimestamp);
          $serviceRow->serviceAdditionalInfo = '';
          $serviceRow->serviceSermonTopic = '';
          $serviceRow->serviceSermonRecording = '';
          $serviceRow->serviceModerator = 0;
          $serviceRow->servicePreacher = 0;
          $serviceRow->staffWorshipLeader = 0;
          $serviceRow->serviceSundaySchoolTeacherSmall = 0;
          $serviceRow->serviceSundaySchoolTeacherBig = 0;
          $serviceRow->serviceAudioEngineer = 0;
          $serviceRow->serviceReceptionist = 0;
          $serviceRow->serviceWorshipMusicians = '';
          $serviceRow->save();
        endif;

        return $serviceRow;
      }

      /**
       * @param int $eventID
       * @return access\object\service|mixed
       */
      private function getServiceRowByEventID($eventID) {

        $serviceFactory = \BB\custom\extension\efgettenheim\access\factory\service::get();
        $serviceRow = $serviceFactory->getRow($eventID);

        return $serviceRow;
      }

      /**
       *
       */
      public function execSaveEvent() {

        $bbRequest = \BB\request\http::get();
        $eventID = $bbRequest->getInteger('eventID');
        $editMode = $bbRequest->getString('mode');
        $sendInfo = $bbRequest->getBoolean('sendInfo');
        $createPdf = $bbRequest->getBoolean('createPdf');
        $songIDs = $bbRequest->getString('songIDs');
        $agendaJSON = $bbRequest->getString('agenda');
        $agenda = json_decode($agendaJSON);

        if($sendInfo):
          $this->sendInfoMail($editMode);
        endif;

        $serviceRow = $this->getServiceRowByEventID($eventID);

        if($editMode == 'songs'):
          $serviceSongBridge = \BB\custom\extension\efgettenheim\access\bridge\serviceSong::get();
          $songs = $serviceSongBridge->getSongRows($eventID);
          $unrelateSongIDs = [];
          foreach($songs as $song):
            $unrelateSongIDs[] = $song->getContentID();
          endforeach;
          $serviceSongBridge->unrelate($eventID, $unrelateSongIDs);
          $serviceSongBridge->relate($eventID, explode('|', $songIDs));
          \brandbox\api\cache\cache::get()->cache = [];
        elseif($editMode == 'agenda'):
          $serviceAgendaBridge = \BB\custom\extension\efgettenheim\access\bridge\serviceAgenda::get();
          $factoryAgenda = \BB\custom\extension\efgettenheim\access\factory\agenda::get();
          $storedAgendas = $serviceAgendaBridge->getAgendaRows($eventID);
          $unrelateAgendaIDs = [];
          foreach($storedAgendas as $storedAgenda):
            $unrelateAgendaIDs[] = $storedAgenda->getContentID();
          endforeach;
          $serviceAgendaBridge->unrelate($eventID, $unrelateAgendaIDs);

          $agendaIDs = array();
          $agendaRows = array();
          foreach($agenda as $agendaPosition):
            $agendaID = $agendaPosition->agendaID;
            $agendaTitle = $agendaPosition->agendaTitle;
            $agendaResponsible = $agendaPosition->agendaResponsible;
            $agendaRemarks = $agendaPosition->agendaRemarks;
            $songID = (int)$agendaPosition->songID;

            if(!is_numeric($agendaID) && mb_substr($agendaID, 0, 3) == 'new'):
              $agendaRow = $factoryAgenda->getRow(0);
            else:
              $agendaRow = $factoryAgenda->getRow($agendaID);
            endif;

            $agendaRow->agendaTitle = $agendaTitle;
            $agendaRow->agendaResponsible = $agendaResponsible;
            $agendaRow->agendaRemarks = $agendaRemarks;
            if($songID > 0):
              $agendaRow->agendaSong = $songID;
            endif;
            $agendaRow->save();
            $agendaRows[] = $agendaRow;
            $agendaIDs[] = $agendaRow->getContentID();

          endforeach;

          $serviceAgendaBridge->relate($eventID, $agendaIDs);
          \brandbox\api\cache\cache::get()->cache = [];

        else:

          $formFieldIdentifiers = $this->getAllowedFormFieldIdentifiers($editMode);

          foreach($formFieldIdentifiers as $formFieldIdentifier):

            if($this->isMultiSelect($formFieldIdentifier)):
              $formFieldValue = $bbRequest->getArray($formFieldIdentifier);
              $formFieldValue = '|'.implode('|', $formFieldValue).'|';
            else:
              $formFieldValue = $bbRequest->getParam($formFieldIdentifier);
            endif;
            $serviceRow->{$formFieldIdentifier} = $formFieldValue;
          endforeach;

          $serviceRow->save();

        endif;

        if($createPdf):
          $agendaPdf = new \BB\custom\extension\efgettenheim\lib\classes\agendaPdf(
            $serviceRow,
            $agendaRows
          );
          $agendaPdf->build();
          $agendaPdf->output();
        endif;


      }

      /**
       * @param string $editMode
       */
      private function sendInfoMail($editMode) {



      }



    }

  }

?>