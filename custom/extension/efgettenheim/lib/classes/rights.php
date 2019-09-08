<?php

  namespace BB\custom\extension\efgettenheim\lib\classes {

    /**
     * Class rights
     * @package BB\custom\extension\efgettenheim\lib\classes
     */
    class rights {

      /**
       * @var int
       */
      private $userID = 0;

      /**
       * @var \BB\custom\extension\efgettenheim\access\object\staff
       */
      private $staffRow = null;


      protected static $instance = null;

      /**
       * @return self
       */
      public static function get($userID) {

        if(static::$instance[$userID] === null):
          $nameOfCalledClass = get_called_class();
          static::$instance[$userID] = new $nameOfCalledClass($userID);
        endif;

        return static::$instance[$userID];
      }

      /**
       * rights constructor.
       * @param int $userID
       */
      public function __construct($userID) {
        $this->userID = $userID;
        $this->getRights();
      }

      /**
       *
       */
      private function getRights() {

        $staffFactory = \BB\custom\extension\efgettenheim\access\factory\staff::get();
        $this->staffRow = $staffFactory->getRow($this->userID);

      }

      /**
       * @return bool
       */
      public function hasRightToManageModerators() {
        return (bool)$this->staffRow->staffRightModeratorManager;
      }

      /**
       * @return bool
       */
      public function hasRightToManagePreachers() {
        return (bool)$this->staffRow->staffRightPreacherManager;
      }

      /**
       * @return bool
       */
      public function hasRightToManageWorship() {
        return (bool)$this->staffRow->staffRightWorshipManager;
      }

      /**
       * @return bool
       */
      public function hasRightToEditWorshipSongs() {
        return (bool)$this->staffRow->staffRightWorshipLeader;
      }

      /**
       * @return bool
       */
      public function hasRightToEditWorshipMusicians() {
        return (bool)$this->staffRow->staffRightWorshipLeader;
      }

      /**
       * @return bool
       */
      public function hasRightToEditSermonTopic() {
        return (bool)$this->staffRow->staffRightPreacher || (bool)$this->staffRow->staffRightModerator;
      }

      /**
       * @return bool
       */
      public function hasRightToEditAgenda() {
        return (bool)$this->staffRow->staffRightModerator;
      }

      /**
       * @return bool
       */
      public function hasRightToManageAudioEngineers() {
        return (bool)$this->staffRow->staffRightAudioEngineeringManager;
      }

      /**
       * @return bool
       */
      public function hasRightToManageSundaySchool() {
        return (bool)$this->staffRow->staffRightSundaySchoolManager;
      }

      /**
       * @return bool
       */
      public function hasRightToManageReception() {
        return (bool)$this->staffRow->staffRightReceptionManager;
      }

    }

  }

?>