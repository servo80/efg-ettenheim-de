<?php

  namespace BB\custom\extension\efgettenheim\lib\exception;

  /**
   *
   */
  class mvvm extends \BB\exception {

    /**
     * @param string $file
     *
     * @return void
     */
    public function display($file = 'default.tpl') {

      ob_clean();

      $path = \BB\custom\extension\efgettenheim\engine::configPath.'exception/templates/'.$file;
      $template = new \BB\template\smarty($path, true);

      $template
        ->add('message', $this->getMessage())
        ->add('className', $this->getClassName())
        ->add('line', $this->getLine())
        ->add('file', $this->getFile())
      ;

      $template->display();
    }
  }

?>