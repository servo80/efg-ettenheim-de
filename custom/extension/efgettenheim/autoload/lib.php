<?php

  namespace BB\custom\extension\efgettenheim\autoload;

  /**
   *
   */
  class lib extends \BB\autoload\autoloader {

    /**
     * @var string
     */
    protected $pattern = 'BB\custom\extension\efgettenheim\lib\\';

    /**
     * @var string
     */
    protected $path = '/custom/extension/efgettenheim/lib/';

    /**
     * @param string $className
     *
     * @return void
     */
    public function load($className) {

      if($this->isResponsible($className) === false)
        return;

      $cleanClassName = $this->getCleanClassName($className);
      $filePath = $this->getFilepath($cleanClassName).'.php';

      $path = APP_ROOT.$filePath;

      if(is_file($path))
        include_once $path;
    }
  }

?>