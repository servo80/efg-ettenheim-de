<?php

  namespace BB\custom\extension\efgettenheim\autoload;

  /**
   *
   */
  class access extends \BB\autoload\autoloader {

    /**
     * @var string
     */
    protected $pattern = 'BB\custom\extension\efgettenheim\access\\';

    /**
     * @var string
     */
    protected $path = '/custom/extension/efgettenheim/access/';

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