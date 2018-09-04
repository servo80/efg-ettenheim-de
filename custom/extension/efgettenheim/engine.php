<?php

  // TODO
  // Lieder suchen, erfassen, bearbeiten
  // Ablauf
  //  - Frontend mit sortable
  //  - PDF-Erstellung
  // Rechte implementieren
  //  - Bearbeitungszeitpunkte (nach Godi nicht mehr änderbar
  //  - Links in Kalender
  //  - Rechteprüfungen beim Öffnen und Speichern
  // Cron mit Infomails implementieren
  // Login-Bereich


  namespace BB\custom\extension\efgettenheim {

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
        $staffFactory = \BB\custom\extension\efgettenheim\access\factory\staff::get();

        foreach($serviceRows as $serviceRow):
          $staffID = $serviceRow->servicePreacher;
          $staffRow = $staffFactory->getRow($staffID);
          $serviceRow->servicePreacher = $staffRow->staffFirstname.' '.$staffRow->staffLastname;
        endforeach;

        $this->view
          ->add('serviceRows', $serviceRows)
          ->assign('h1', $this->values['h1']['cnv_value'])
          ->assign('h2', $this->values['h2']['cnv_value'])
        ;

      }

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
        $songs = $serviceSongBridge->getSongRows($serviceRow->getContentID());

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

          case 'sermonTopic':
            $formFieldIdentifiers = [
              'serviceSermonTopic'
            ];
            break;

          case 'songs':
            $formFieldIdentifiers = [
            ];
            break;

          default:
            $formFieldIdentifiers = [
              'serviceModerator',
              'servicePreacher',
              'serviceWorshipMusicians',
              'serviceWorshipLeader',
              'serviceSundaySchoolTeacherSmall',
              'serviceSundaySchoolTeacherBig',
              'serviceAudioEngineer',
              'serviceReceptionist'
            ];

            break;

        endswitch;

        return $formFieldIdentifiers;
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
        $songIDs = $bbRequest->getString('songIDs');

        if($sendInfo):
          $this->sendInfoMail($editMode);
        endif;

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
        endif;

        $formFieldIdentifiers = $this->getAllowedFormFieldIdentifiers($editMode);
        $serviceRow = $this->getServiceRowByEventID($eventID);

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

      }

      /**
       * @param string $editMode
       */
      private function sendInfoMail($editMode) {



      }



    }

  }

?>