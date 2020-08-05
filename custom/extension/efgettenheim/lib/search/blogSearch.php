<?php

  namespace BB\custom\extension\efgettenheim\lib\search {

    /**
     * Class blogSearch
     * @package BB\custom\extension\efgettenheim\lib\search
     */
    class blogSearch extends \BB\access\search {

      /**
       * eventSearch constructor.
       */
      public function __construct() {
      }

      /**
       *
       */
      public function build() {

        $conditionTimestamp = $this->getConditionTimestampFromTo();
        $this->add($conditionTimestamp);
        $this->add(new \BB\access\conditionAnd());

      }

      /**
       * @return \BB\access\conditionFieldset
       */
      private function getConditionTimestampFromTo() {

        $fieldset = new \BB\access\conditionFieldset();

        $fieldTo = new \BB\access\conditionField();
        $fieldTo
          ->id(\BB\custom\extension\efgettenheim\access\field\de\eventDate::class)
          ->sortDesc();


        $fieldset->add($fieldTo);
        $fieldset->add(new \BB\access\conditionAnd());

        return $fieldset;

      }

    }

  }

?>