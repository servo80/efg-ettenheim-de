<?php

  namespace BB\custom\extension\efgettenheim\lib\search {

    /**
     * Class eventSearch
     * @package BB\custom\extension\efgettenheim\lib\search
     */
    class sermonSearch extends \BB\access\search {

      private $timestamp = 0;

      /**
       * eventSearch constructor.
       * @param $timestamp
       */
      public function __construct($timestamp) {

        $this->timestamp = $timestamp-1000*24*60*60;

      }

      /**
       *
       */
      public function build() {

        $conditionTimestamp = $this->getConditionTimestamp();
        $conditionSermonRecordingNotEmpty = $this->getConditionSermonRecordingNotEmpty();
        $this->add($conditionTimestamp);
        $this->add($conditionSermonRecordingNotEmpty);
        $this->add(new \BB\access\conditionAnd());

      }

      /**
       * @return \BB\access\conditionField
       */
      private function getConditionSermonRecordingNotEmpty() {

        $field = new \BB\access\conditionField();
        $field
          ->id(\BB\custom\extension\efgettenheim\access\field\de\serviceSermonRecording::class)
          ->isNot("")
        ;

        return $field;

      }

      /**
       * @return \BB\access\conditionField
       */
      private function getConditionTimestamp() {

        $field = new \BB\access\conditionField();
        $field
          ->id(\BB\custom\extension\efgettenheim\access\field\de\serviceDate::class)
          ->isGreaterThan($this->timestamp)
          ->sortDesc()
        ;

        return $field;

      }

    }

  }

?>