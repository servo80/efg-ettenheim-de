<?php

  namespace BB\custom\extension\efgettenheim;

  /**
   *
   */
  class hook extends \BB\model\hook {

    protected static $instance = null;

    private $map = array(
    );

    /**
     * @return self
     */
    public static function get() {

      if(static::$instance === null):
        $nameOfCalledClass = get_called_class();
        static::$instance = new $nameOfCalledClass();
      endif;

      return static::$instance;
    }

    /**
     * @param string $class
     * @param string $method
     * @param array $options
     * @return mixed
     */
    public function call($class, $method, $options) {

      if(isset($this->map[$class][$method]))
        call_user_func(array($this, $this->map[$class][$method]), $options);
    }
  }

?>