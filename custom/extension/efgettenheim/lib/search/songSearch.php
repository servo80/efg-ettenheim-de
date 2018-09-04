<?php

  namespace BB\custom\extension\efgettenheim\lib\search {

    /**
     * Class eventSearch
     * @package BB\custom\extension\efgettenheim\lib\search
     */
    class songSearch extends \BB\access\search {

      private $searchTerm = '';

      /**
       * eventSearch constructor.
       * @param $searchTerm
       */
      public function __construct($searchTerm) {

        $this->searchTerm = $searchTerm;

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
          ->id(\BB\custom\extension\efgettenheim\access\field\de\songTitle::class)
          ->like('%'.$this->searchTerm.'%');

        return $field;

      }

    }

  }

?>