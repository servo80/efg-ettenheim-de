<?php

  namespace BB\custom\autoload;

  if(@secure !== true)
    die('forbidden');

  /**
   * @author Brandbox
   */

  class fallbackModel extends \BB\autoload\autoloader {

    /**
     * @var string
     */
    protected $pattern = 'BB\custom\model\\';

    /**
     * @var string
     */
    protected $path = '/custom/';

    /**
     * @param string $className
     *
     * @return void
     */
    public function load($className) {

      $cleanClassName = $this->getCleanClassName($className);
      $filepath = $this->getFilepath($cleanClassName);

      $basename = $this->getBasename($filepath);
      $filename = $basename.'.php';

      $dirnames = [
        'model/',
        'extension/databaseObjects/classes/',
        'extension/efgettenheim/access/bridge/',
        'extension/efgettenheim/access/factory/',
        'extension/efgettenheim/access/field/de/',
        'extension/efgettenheim/access/object/',
        ];

      foreach($dirnames as $dirname):

        if(substr_count($filepath, '/') == 3):
          $replace = 'custom/model/';
          $filepathDir = dirname($filepath);
          $moduleName = str_replace($replace, '', $filepathDir);
          $dirname = 'module/'.$moduleName.'/model/';
        endif;

        $path = APP_ROOT.$this->path.$dirname.$filename;

        if(is_file($path)):
          include_once $path;
        endif;

      endforeach;

    }

  }

?>