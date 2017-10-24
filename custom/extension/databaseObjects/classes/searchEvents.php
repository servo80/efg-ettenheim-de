<?php

  namespace BB\custom\extension\simpleObjects\classes;

  if(@secure !== true)
    die('forbidden');

  class searchEvents extends \BB\access\search {

    /**
     *
     */
    public function viewEvents(){


      $eventsFactory = \BB\custom\extension\efgettenheim\access\factory\events::get();
      $eventsFactory->searchRows();

      $this->view->assign('testimonial', $testimonial->Testimonial);
      $this->view->assign('person', $testimonial->Zitierer);

    }

  }

?>