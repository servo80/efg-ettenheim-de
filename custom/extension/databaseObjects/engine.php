<?php

  namespace BB\custom\extension\databaseObjects;

  if(@secure !== true)
    die('forbidden');

  class engine extends \BB\engine\common {

    protected $path = 'custom/extension/simpleObject1.0/';

    protected $error = false;
    protected $sent = false;
    protected $captchaSuccess = false;

    /**
     *
     */
    public function viewEventsDynamic(){

      $eventsSearch = new classes\eventsSearch();
      $eventsFactory = \BB\custom\extension\efgettenheim\access\factory\events::get();
      $rows = $eventsFactory->searchRows($eventsSearch, true);

      foreach($rows as $row):
        if($row->eventLink != ''):
          $row->eventLink = $this->getLink($row->eventLink, true);
        endif;
      endforeach;

      $this->view
        ->add('rows', $rows)
        ->assign('h1', $this->values['h1']['cnv_value'])
        ->assign('h2', $this->values['h2']['cnv_value'])
        ;

    }

      /**
       *
       */
      public function viewEventsDynamicList(){

          $eventsSearch = new classes\eventsSearch();
          $eventsFactory = \BB\custom\extension\efgettenheim\access\factory\events::get();
          $rows = $eventsFactory->searchRows($eventsSearch, true);

          foreach($rows as $row):
              if($row->eventLink != ''):
                  $row->eventLink = $this->getLink($row->eventLink, true);
              endif;
          endforeach;

          $this->view
              ->add('rows', $rows)
              ->assign('h1', $this->values['h1']['cnv_value'])
              ->assign('h2', $this->values['h2']['cnv_value'])
          ;

      }

    /**
     *
     */
    public function viewContact() {

      $coreHttp = \BB\request\http::get();
      $fullname = $coreHttp->getString('fullname');
      $email = $coreHttp->getString('email');
      $message = $coreHttp->getString('message');
      $sent = $coreHttp->getInteger('sent');


      $this->view
        ->add('fullname', $fullname)
        ->add('email', $email)
        ->add('message', $message)
        ->add('captchaSuccess', $this->captchaSucess)
        ->add('error', $this->error)
        ->add('sent', ($this->sent && $sent == 1))
        ->add('notsent', (!$this->sent && $sent == 1))
        ;

    }

    /**
     *
     */
    public function execSendContact() {

      $coreHttp = \BB\request\http::get();
      $recaptcha = $coreHttp->getString('g-recaptcha-response');
      $this->captchaSuccess = $this->checkRecaptcha($recaptcha);
      $name = $coreHttp->getString('fullname');
      $email = $coreHttp->getString('email');
      $message = $coreHttp->getString('message');

      if($this->captchaSuccess && $name != '' && $email != '' && $message != ''):
        $this->sent = $this->sendMail($name, $email, $message);
      else:
        $this->error = true;
      endif;

    }

    /**
     * @param $name
     * @param $email
     * @param $message
     */
    private function sendMail($name, $email, $message) {

      $coreMail = new \BB\mail\PHPMailer();
      $coreMail->From = 'kontakt@efg-ettenheim.de';
      $coreMail->FromName = 'Kontaktformular';
      $coreMail->CharSet = 'UTF-8';
      $coreMail->Subject = 'Anfrage über das Kontakformular auf efg-ettenheim.de';
      $coreMail->IsHTML(false);
      $coreMail->Body =
        "Name: ".$name."\n".
        "E-Mail: ".$email."\n".
        "Nachricht: ".$message;


      if(\BB\config::get('mail:smtp:host') != ''):
        $coreMail->IsSMTP(true);
        $coreMail->Host = \BB\config::get('mail:smtp:host');
        /*
		$coreMail->SMTPDebug = 4;
		$coreMail->Debugoutput = function($str, $level) {
		  echo $str."<br>";
		};
		*/
        $coreMail->SMTPAuth = \BB\config::get('mail:smtp:auth');;
        $coreMail->Port = \BB\config::get('mail:smtp:port');
        $coreMail->Username = \BB\config::get('mail:smtp:username');
        $coreMail->Password = \BB\config::get('mail:smtp:password');
      endif;

      $coreMail->AddAddress('philipp.frick@googlemail.com');
      $coreMail->AddAddress('daniela.przibilla@googlemail.com');
      return $coreMail->Send();
    }

    /**
     * @param $recaptcha
     * @return bool
     */
    private function checkRecaptcha($recaptcha) {

      $fields = array(
        'secret' => '6LeTtDUUAAAAAP-uBeZakTFHCj0lTK3APOo3Fe_4',
        'response' => $recaptcha
      );

      $fieldsString = http_build_query($fields);

      $url = 'https://www.google.com/recaptcha/api/siteverify';

      $ch = \curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $fieldsString);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
      curl_setopt($ch, CURLOPT_TIMEOUT, 5);
      $response = curl_exec($ch);
      curl_close($ch);

      return (bool)$response['success'];

    }

  }

?>