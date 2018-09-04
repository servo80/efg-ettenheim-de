<?php

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

        $calendarEvents = [
          [
            'title' => "test",
            'start' => "2018-08-21 10:00"
          ]
        ];

        $this->view
          ->assign('calendarEvents', json_encode($calendarEvents))
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

      /**
       *
       */
      public function viewEditEvent(){

        $bbRequest = \BB\request\http::get();
        $eventTimestamp = $bbRequest->getString('eventTimestamp');

        $serviceRow = $this->getServiceRowByEventTimestamp($eventTimestamp);

        $modelField = \BB\model\field::get();

        $formFieldIdentifiers = $this->getAllowedFormFieldIdentifiers();

        foreach($formFieldIdentifiers as $formFieldIdentifier):

          $formFieldField = $modelField->getField($formFieldIdentifier);
          $formFieldValue = $serviceRow->{$formFieldIdentifier};

          $options = [
            'languageID' => 1,
            'fieldName' => $formFieldIdentifier,
            'fieldValue' => $formFieldValue,
            'field' => $formFieldField,
            'attribute' => '',
            'userID' => 0
          ];

          $formField = \BB\model\formField::instance($options);
          $this->view
            ->assign('formField'.ucfirst($formFieldIdentifier), $formField->getField());

        endforeach;

        $this->view
          ->assign('eventID', $serviceRow->getContentID());

      }

      /**
       * @return array
       */
      private function getAllowedFormFieldIdentifiers() {

        return [
          'serviceModerator',
          'servicePreacher',
          'serviceWorshipMusicians',
        ];

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

        $formFieldIdentifiers = $this->getAllowedFormFieldIdentifiers();
        $serviceRow = $this->getServiceRowByEventID($eventID);
        print_r($serviceRow);exit;
        foreach($formFieldIdentifiers as $formFieldIdentifier):
          $formFieldValue = $bbRequest->getString($formFieldIdentifier);
          if(is_array($formFieldValue)):
            $formFieldValue = implode('|', $formFieldValue);
          endif;
          $serviceRow->{$formFieldIdentifier} = $formFieldValue;
        endforeach;
print_r($serviceRow);
        $serviceRow->save();

      }

    }

  }

?>