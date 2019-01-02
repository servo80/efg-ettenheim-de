<?php

  namespace BB\custom\module\cron {

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

        $lastKey = count($argv)-1;

        switch($argv[$lastKey]):

          case 'sendReminders':
            $this->sendReminders();
            break;

        endswitch;

      }

      /**
       *
       */
      private function sendReminders() {

        // Alle Events holen, die in den nächsten 6 Tagen stattfinden
        $currentTimestamp = time();
        $triggerTimestamp = $currentTimestamp + 6*24*60*60;
        $fromTimestamp = mktime(0, 0, 0, strftime('%m', $currentTimestamp), strftime('%d', $currentTimestamp), strftime('%Y', $currentTimestamp));
        $toTimestamp = mktime(23, 59, 0, strftime('%m', $triggerTimestamp), strftime('%d', $triggerTimestamp), strftime('%Y', $triggerTimestamp));

        $serviceSearch = new \BB\custom\extension\efgettenheim\lib\search\eventSearch($fromTimestamp, $toTimestamp);
        $serviceFactory = \BB\custom\extension\efgettenheim\access\factory\service::get();
        $serviceRows = $serviceFactory->searchRows($serviceSearch, true);

        foreach($serviceRows as $serviceRow):

          $serviceSongBridge = \BB\custom\extension\efgettenheim\access\bridge\serviceSong::get();
          $songs = $serviceSongBridge->getSongRows($serviceRow->getContentID());

          $serviceAgendaBridge = \BB\custom\extension\efgettenheim\access\bridge\serviceAgenda::get();
          $agenda = $serviceAgendaBridge->getAgendaRows($serviceRow->getContentID());

          // wenn Moderator fehlt, Moderatormanager benachrichtigen
          if(empty($serviceRow->serviceModerator)):
            $receivers = $this->getModeratorManagers();
            $this->sendMail($receivers, 'moderator_missing', $serviceRow, true);
            continue;

          // wenn Lobpreisleiter fehlt, Lobpreismanager benachrichtigen
          elseif(empty($serviceRow->serviceWorshipLeader)):
            $receivers = $this->getWorshipManagers();
            $this->sendMail($receivers, 'worship_leader_missing', $serviceRow, true);
            continue;

          // wenn Predigtthema fehlt, Moderator benachrichtigen
          elseif(empty($serviceRow->serviceSermonTopic)):
            $receivers = [$this->getStaffEmail($serviceRow->serviceModerator)];
            $this->sendMail($receivers, 'sermon_topic_missing', $serviceRow);
            continue;


          // wenn Lieder fehlen, Lobpreisleiter mit Predigtthema benachrichtigen
          elseif(count($songs) === 0):
            $receivers = [$this->getStaffEmail($serviceRow->serviceWorshipLeader)];
            $this->sendMail($receivers, 'songs_missing', $serviceRow);
            continue;

          // wenn Ablauf fehlt, Moderator benachrichtigen
          elseif(count($agenda) === 0):
            $receivers = [$this->getStaffEmail($serviceRow->serviceModerator)];
            $this->sendMail($receivers, 'agenda_missing', $serviceRow);
            continue;

          // wenn Ablauf vorhanden, Ablauf an alle schicken (Musikteam, Prediger)
          else:
            $receivers = $this->getServiceStaffEmails($serviceRow);
            $this->sendMail($receivers, 'agenda_final', $serviceRow);
          endif;

        endforeach;

      }

      /**
       * @param \BB\custom\extension\efgettenheim\access\object\service $serviceRow
       * @return array
       */
      private function getServiceStaffEmails($serviceRow) {

        $userIDs = [
          $serviceRow->serviceModerator,
          $serviceRow->serviceWorshipLeader,
          $serviceRow->serviceSundaySchoolTeacherSmall,
          $serviceRow->serviceSundaySchoolTeacherBig,
          $serviceRow->serviceReceptionist,
          $serviceRow->serviceAudioEngineer,
          $serviceRow->servicePreacher
        ];

        $userIDs = array_merge($userIDs, $serviceRow->serviceWorshipMusicians);

        $staffEmails = [];
        foreach($userIDs as $userID):
          if(0 !== (int)$userID):
            $staffEmail = $this->getStaffEmail($userID);
            if(!empty($staffEmail) && \BB\info::isMail($staffEmail)):
              $staffEmails[] = $staffEmail;
            endif;
          endif;
        endforeach;

        return $staffEmails;
      }

      /**
       * @param int $userID
       * @return string
       */
      private function getStaffEmail($userID) {

        $staffFactory = \BB\custom\extension\efgettenheim\access\factory\staff::get();
        $staffRow = $staffFactory->getRow($userID);

        return $staffRow->staffEmail;
      }

      /**
       * @param array $receivers
       * @param string $type
       * @param bool $urgent
       * @param \BB\custom\extension\efgettenheim\access\object\service $serviceRow
       */
      protected function sendMail($receivers, $type, $serviceRow, $urgent = false) {

        $mailTpl = new \BB\template\classic('custom/extensions/efgettenheim/templates/mail.tpl');
        $mailTpl->add('serviceRow', $serviceRow);
        $mailTpl->add('type', $type);

        $mailer = new \BB\mail\PHPMailer();
        $mailer->From = 'gottesdienst@efg-ettenheim.de';
        $mailer->FromName = 'EFG Ettenheim - Gottesdienstplanung';
        $mailer->Subject = 'Gottesdienst am '.strftime('%d.%m.%Y', $serviceRow->serviceDate).($urgent ? ' - Dringender Handlungsbedarf!' : '');

        foreach($receivers as $receiver):
          $mailer->addBCC($receiver);
        endforeach;

        $mailer->IsHTML(true);
        $mailer->CharSet = 'UTF-8';
        $mailer->AddEmbeddedImage('custom/themes/efg-ettenheim-de/img/logo.png', 'logo.png');
        //$mailer->AddBcc('info@ehe-initiative.de');
        $mailer->Body = $mailTpl->get();
        $mailer->Send();

      }

    }

  }

?>