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
        $this->limit = 1000;

      }

      /**
       *
       */
      public function build() {

        $conditionTimestamp = $this->getConditionSongTitle();
        $this->add($conditionTimestamp);
        $this->add(new \BB\access\conditionAnd());

      }

      /**
       * @return \BB\access\conditionField
       */
      private function getConditionSongTitle() {

        $field = new \BB\access\conditionField();
        $field
          ->id(\BB\custom\extension\efgettenheim\access\field\de\songTitle::class)
          ->like('%'.$this->searchTerm.'%')
          ->sortAsc();

        return $field;

      }

    }

  }

?>