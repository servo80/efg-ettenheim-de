<?php

  namespace BB\custom\extension\efgettenheim\lib\classes\pattern;

  /**
   *
   */
  abstract class singleton extends \BB\custom\extension\efgettenheim\lib\classes\pattern\facade {

    /**
     * @var object
     */
    protected static $instance = null;

    /**
     * @return self
     */
    public static function get() {

      if(static::$instance === null):
        static::$instance = new static();
      endif;

      return static::$instance;
    }

    /**
     * @return self
     */
    protected function __construct() {
      $this->initialize();
    }

  }

?>