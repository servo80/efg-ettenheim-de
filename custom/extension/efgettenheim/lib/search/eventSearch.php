<?php

  namespace BB\custom\extension\efgettenheim\lib\search {

    /**
     * Class eventSearch
     * @package BB\custom\extension\efgettenheim\lib\search
     */
    class eventSearch extends \BB\access\search {

      private $timestamp = 0;

      /**
       * eventSearch constructor.
       * @param $timestamp
       */
      public function __construct($timestamp) {

        $this->timestamp = $timestamp;

      }

      /**
       *
       */
      public function build() {

        $conditionTimestamp = $this->getConditionTimestamp();
        $this->add($conditionTimestamp);
        $this->add(new \BB\access\conditionAnd());

      }

      /**
       * @return \BB\access\conditionField
       */
      private function getConditionTimestamp() {

        $field = new \BB\access\conditionField();
        $field
          ->id(\BB\custom\extension\efgettenheim\access\field\de\serviceDate::class)
          ->isEqual($this->timestamp);

        return $field;

      }

    }

  }

?>