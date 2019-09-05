<?php

  namespace BB\custom\extension\efgettenheim\lib\search {

    /**
     * Class eventSearch
     * @package BB\custom\extension\efgettenheim\lib\search
     */
    class eventSearch extends \BB\access\search {

      private $timestamp = 0;
      private $fromTimestamp = 0;
      private $toTimestamp = 0;

      /**
       * eventSearch constructor.
       * @param int $fromTimestamp
       * @param int $toTimestamp
       */
      public function __construct($fromTimestamp, $toTimestamp = 0) {

        if(0 === $toTimestamp):
          $this->timestamp = $fromTimestamp;
        else:
          $this->fromTimestamp = $fromTimestamp;
          $this->toTimestamp = $toTimestamp;
        endif;

      }

      /**
       *
       */
      public function build() {

        if(0 !== $this->timestamp):
          $conditionTimestamp = $this->getConditionTimestamp();
          $this->add($conditionTimestamp);
        elseif(0 !== $this->fromTimestamp && 0 !== $this->toTimestamp):
          $conditionTimestamp = $this->getConditionTimestampFromTo();
          $this->add($conditionTimestamp);
        endif;
        $this->add(new \BB\access\conditionAnd());

      }

      /**
       * @return \BB\access\conditionFieldset
       */
      private function getConditionTimestampFromTo() {

        $fieldset = new \BB\access\conditionFieldset();

        $fieldFrom = new \BB\access\conditionField();
        $fieldFrom
          ->id(\BB\custom\extension\efgettenheim\access\field\de\serviceDate::class)
          ->isGreaterThan($this->fromTimestamp);

        $fieldTo = new \BB\access\conditionField();
        $fieldTo
          ->id(\BB\custom\extension\efgettenheim\access\field\de\serviceDate::class)
          ->isLessThan($this->toTimestamp)
          ->sortAsc();


        $fieldset->add($fieldFrom);
        $fieldset->add($fieldTo);
        $fieldset->add(new \BB\access\conditionAnd());

        return $fieldset;

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