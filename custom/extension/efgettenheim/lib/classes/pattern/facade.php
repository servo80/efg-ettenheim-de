<?php

  namespace BB\custom\extension\efgettenheim\lib\classes\pattern;

  /**
   * @property \BB\custom\extension\efgettenheim\lib\classes\view $extView
   */
  abstract class facade extends \BB\model\pattern\brandbox {

    protected $modelMap = array(
      'extPageview' => '\BB\custom\extension\efgettenheim\lib\classes\pageview',
      'extView' => '\BB\custom\extension\efgettenheim\lib\classes\view'
    );

    protected $modelInstances = array();

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name) {
      if(substr($name, 0, 4) != 'ext')
        return parent::__get($name);

      if($this->modelExists($name) === false)
        $this->setModel($name);

      return $this->modelInstances[$name];
    }

    /**
     * @return array
     */
    public function getModelMap() {
      return $this->modelMap;
    }

    /**
     * @param string $name
     * @param null|object $object
     */
    public function setModel($name, $object = null) {

      if(empty($object)):
        $object = call_user_func(
          array(
            $this->modelMap[$name],
            'get'
          )
        );
      endif;

      $this->modelInstances[$name] = $object;
    }

    /**
     * @param string $name
     * @return boolean
     */
    public function modelExists($name) {
      $isset = isset($this->modelInstances[$name]);

      return $isset;
    }
  }

?>