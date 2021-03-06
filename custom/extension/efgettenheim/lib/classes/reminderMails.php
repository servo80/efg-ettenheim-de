<?php

  namespace BB\custom\extension\efgettenheim\lib\classes {

    /**
     * Class rights
     * @package BB\custom\extension\efgettenheim\lib\classes
     */
    class reminderMails {

      /**
       *
       */
      public function sendReminders() {

        $oneDay = 24*60*60;
        $twoDays = 2*$oneDay;
        $threeDays = 3*$oneDay;
        $fourDays = 4*$oneDay;
        $sixDays = 6*$oneDay;
        $hoursBuffer = 3*60*60;

        // Alle Events holen, die in den nächsten 6 Tagen stattfinden
        $currentTimestamp = time();
        $triggerTimestamp = $currentTimestamp + $sixDays;
        $fromTimestamp = mktime(12, 0, 0, strftime('%m', $currentTimestamp), strftime('%d', $currentTimestamp), strftime('%Y', $currentTimestamp));
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

            // ab 4 Tage vorher benachrichtigen
            if($currentTimestamp > $serviceRow->serviceDate - $fourDays - $hoursBuffer):
              $receivers = [$this->getStaffEmail($serviceRow->serviceModerator)];
              $this->sendMail($receivers, 'sermon_topic_missing', $serviceRow);
            endif;
            continue;

          // wenn Lieder fehlen, Lobpreisleiter mit Predigtthema benachrichtigen
          elseif(count($songs) === 0):

            // ab 3 Tage vorher benachrichtigen
            if($currentTimestamp > $serviceRow->serviceDate - $threeDays - $hoursBuffer):
              $receivers = [$this->getStaffEmail($serviceRow->serviceWorshipLeader)];
              $this->sendMail($receivers, 'songs_missing', $serviceRow);
            endif;
            continue;

          // wenn Ablauf fehlt, Moderator benachrichtigen
          elseif(count($agenda) === 0):

            // ab 2 Tage vorher benachrichtigen
            if($currentTimestamp > $serviceRow->serviceDate - $twoDays - $hoursBuffer):
              $receivers = [$this->getStaffEmail($serviceRow->serviceModerator)];
              $this->sendMail($receivers, 'agenda_missing', $serviceRow);
            endif;
            continue;

          // wenn Ablauf vorhanden, Ablauf an alle schicken (Musikteam, Prediger)
          else:
            $receivers = $this->getServiceStaffEmails($serviceRow);

            $agendaPdf = new \BB\custom\extension\efgettenheim\lib\classes\agendaPdf(
              $serviceRow,
              $agenda
            );
            $agendaPdf->build();
            $filename = $agendaPdf->save();

            $this->sendMail($receivers, 'agenda_final', $serviceRow, false, $filename);
          endif;

        endforeach;

      }

      /**
       * @return \BB\access\object[]|\BB\custom\extension\efgettenheim\access\object\staff[]
       */
      private function getModeratorManagers() {

        $staffSearch = new \BB\custom\extension\efgettenheim\lib\search\staffSearch();
        $staffFactory = \BB\custom\extension\efgettenheim\access\factory\staff::get();
        $staffIDs = $staffFactory->searchContentIDs($staffSearch);

        return $this->getMailAddressesByUserIDs($staffIDs);
      }

      /**
       * @return int[]
       */
      private function getWorshipManagers() {

        $staffSearch = new \BB\custom\extension\efgettenheim\lib\search\staffSearch(false, true);
        $staffFactory = \BB\custom\extension\efgettenheim\access\factory\staff::get();
        $staffIDs = $staffFactory->searchContentIDs($staffSearch);

        return $this->getMailAddressesByUserIDs($staffIDs);
      }

      /**
       * @param \BB\custom\extension\efgettenheim\access\object\service $serviceRow
       * @return array
       */
      private function getServiceStaffEmails($serviceRow) {

        $userIDs = [
          $serviceRow->serviceModerator,
          $serviceRow->serviceWorshipLeader,
          $serviceRow->serviceReceptionist,
          $serviceRow->serviceAudioEngineer,
          $serviceRow->servicePreacher
        ];

        $userIDs = array_merge($userIDs, explode('|', trim($serviceRow->serviceWorshipMusicians, '|')));
        $userIDs = array_merge($userIDs, explode('|', trim($serviceRow->serviceSundaySchoolTeacherSmall, '|')));
        $userIDs = array_merge($userIDs, explode('|', trim($serviceRow->serviceSundaySchoolTeacherBig, '|')));

        return $this->getMailAddressesByUserIDs($userIDs);

      }

      /**
       * @param array $userIDs
       * @return array
       */
      private function getMailAddressesByUserIDs($userIDs) {

        $staffEmails = [];
        foreach($userIDs as $userID):
          if(0 !== (int)$userID):
            $staffEmail = $this->getStaffEmail($userID);
            if(!empty($staffEmail) && \BB\info::isMail($staffEmail)):
              $staffEmails[] = $staffEmail;
            endif;
          endif;
        endforeach;

        return array_unique($staffEmails);

      }

      /**
       * @return array
       */
      private function getSongBookIDsAsNames() {
        $songBookSearch = new \BB\custom\extension\efgettenheim\lib\search\songBookSearch('');
        $songBookFactory = \BB\custom\extension\efgettenheim\access\factory\songBook::get();
        $songBookRows = $songBookFactory->searchRows($songBookSearch, true);

        $songBooksIDsAsNames = [];
        foreach($songBookRows as $songBookRow):
          $songBooksIDsAsNames[$songBookRow->getContentID()] = $songBookRow->songBookTitle;
        endforeach;

        return $songBooksIDsAsNames;
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
       * @param string $attachment
       * @param \BB\custom\extension\efgettenheim\access\object\service $serviceRow
       * @return bool
       */
      public function sendMail($receivers, $type, $serviceRow, $urgent = false, $attachment = '') {

        $songs = [];
        if($type === 'agenda_missing'):

          $serviceSongBridge = \BB\custom\extension\efgettenheim\access\bridge\serviceSong::get();
          $songs = $serviceSongBridge->getSongRows($serviceRow->getContentID());

          $songBooksIDsAsNames = $this->getSongBookIDsAsNames();
          foreach($songs as $song):
            $song->songTitle = $song->songTitle.' ('.$songBooksIDsAsNames[$song->songBook].', '.$song->songNumber.')';
          endforeach;

        endif;

        $mailTpl = new \BB\template\classic('custom/extension/efgettenheim/templates/mail.tpl');
        $mailTpl->add('serviceRow', $serviceRow);
        $mailTpl->add('type', $type);
        $mailTpl->add('songs', $songs);

        $mailer = new \BB\mail\PHPMailer();
        $mailer->From = \BB\config::get('mail:address');
        $mailer->FromName = \BB\config::get('mail:name');
        $mailer->Subject = 'Gottesdienst am '.strftime('%d.%m.%Y', $serviceRow->serviceDate).($urgent ? ' - Dringender Handlungsbedarf!' : '');

        foreach($receivers as $receiver):
          $mailer->addBCC($receiver);
        endforeach;

        if('agenda_final' === $type):
          $mailer->addBCC('efgettenheim.technik@gmail.com');
        endif;

        $mailer->addBCC('philipp.frick@googlemail.com');

        if(!empty(APP_ROOT.$attachment && file_exists(APP_ROOT.$attachment))):
          $mailer->addAttachment(APP_ROOT.$attachment);
        endif;

        $mailer->IsHTML(true);
        $mailer->CharSet = 'UTF-8';
        $mailer->AddEmbeddedImage('custom/themes/efg-ettenheim-de/img/logo-2.png', 'logo.png');
        $mailer->Body = $mailTpl->get();

        if(\BB\config::get('mail:smtp:host') != ''):
          $mailer->IsSMTP();
          $mailer->Host = \BB\config::get('mail:smtp:host');
          //$mailer->SMTPDebug  = 2;
          $mailer->SMTPAuth = \BB\config::get('mail:smtp:auth');
          $mailer->SMTPSecure = \BB\config::get('mail:smtp:secure');
          $mailer->Port = \BB\config::get('mail:smtp:port');
          $mailer->Username = \BB\config::get('mail:smtp:username');
          $mailer->Password = \BB\config::get('mail:smtp:password');
        endif;

        $success = $mailer->Send();

        return $success;

      }

    }

  }

?>