<?php

  namespace BB\custom\engine;

  if(@secure !== true)
    die('forbidden');

  class simpleObjects extends \BB\engine\common {

    protected $path = 'custom/extension/simpleObject1.0/';

    /**
     *
     */
    public function viewEvents(){

      /*
      $eventsFactory = \BB\custom\extension\efgettenheim\access\factory\events::get();
      $eventsFactory->searchRows();

      $this->view->assign('testimonial', $testimonial->Testimonial);
      $this->view->assign('person', $testimonial->Zitierer);
      */

    }

  }

?>