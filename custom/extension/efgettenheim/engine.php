<?php

  namespace BB\custom\extension\efgettenheim {

    if(@secure !== true)
      die('forbidden');

    class engine extends \BB\engine\common {

      protected $path = 'custom/extension/efgettenheim/';

      protected $error = false;
      protected $sent = false;
      protected $captchaSuccess = false;

      /**
       *
       */
      public function viewCalendar(){

        $this->view
          ->add('rows', $rows)
          ->assign('h1', $this->values['h1']['cnv_value'])
          ->assign('h2', $this->values['h2']['cnv_value'])
        ;

      }

    }

  }

?>