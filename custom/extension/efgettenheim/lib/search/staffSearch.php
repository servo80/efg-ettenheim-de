<?php

  namespace BB\custom\extension\efgettenheim\lib\search {

    /**
     * Class eventSearch
     * @package BB\custom\extension\efgettenheim\lib\search
     */
    class staffSearch extends \BB\access\search {

      private $timestamp = 0;
      private $fromTimestamp = 0;
      private $toTimestamp = 0;

      /**
       * staffSearch constructor.
       * @param bool $moderatorManager
       * @param bool $worshipManager
       */
      public function __construct($moderatorManager = true, $worshipManager = false, $worshipLeader = false) {
        $this->moderatorManager = $moderatorManager;
        $this->worshipManager = $worshipManager;
        $this->worshipLeader = $worshipLeader;
      }

      /**
       *
       */
      public function build() {

        $conditionManager = $this->getConditionManager();
        $this->add($conditionManager);
        $this->add(new \BB\access\conditionAnd());

      }

      /**
       * @return \BB\access\conditionField
       */
      private function getConditionManager() {

        if($this->moderatorManager):
          $fieldID = \BB\custom\extension\efgettenheim\access\field\de\staffRightModeratorManager::class;
        elseif($this->worshipManager):
          $fieldID = \BB\custom\extension\efgettenheim\access\field\de\staffRightWorshipManager::class;
        else:
          $fieldID = \BB\custom\extension\efgettenheim\access\field\de\staffRightWorshipLeader::class;
        endif;

        $field = new \BB\access\conditionField();
        $field
          ->id($fieldID)
          ->isEqual(1);

        return $field;

      }

    }

  }

?>