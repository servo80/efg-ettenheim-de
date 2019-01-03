<?php

  namespace BB\custom\module\cron {

    use \BB\custom\extension\efgettenheim;

    /**
     * Class controller
     * @package BB\custom\module\cron
     */
    class controller extends \BB\module\cron\controller {

      /**
       * @param int $day
       * @param int $hour
       * @param int $minute
       */
      public function execCustomCron($day, $hour, $minute) {

        global $argv;

        //$lastKey = count($argv)-1;
        //$lastKeyName = $argv[$lastKey];
        $lastKeyIndex = count($_GET)-1;
        $lastKeyName = array_keys($_GET)[$lastKeyIndex];

        switch($lastKeyName):

          case 'sendReminders':
            $this->sendReminders();
            break;

        endswitch;

      }

      /**
       *
       */
      private function sendReminders() {

        $reminderMails = new efgettenheim\lib\classes\reminderMails();
        $reminderMails->sendReminders();

      }

    }

  }

?>