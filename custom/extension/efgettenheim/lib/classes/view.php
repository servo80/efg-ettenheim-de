<?php

  namespace BB\custom\extension\efgettenheim\lib\classes;

  /**
   * @method view()
   */
  class view extends \BB\custom\extension\efgettenheim\lib\classes\pattern\singleton {

    protected static $instances = array();
    /* @var $view \BB\template\smarty */
    protected $view;
    /** @var $engine \BB\engine\mvvm */
    protected $engine;

    /**
     * @param $engine
     * @return self
     */
    public function __construct($engine) {
      parent::__construct();
      $this->engine = $engine;
    }

    /**
     * @param \BB\engine\common $engine
     * @return self
     */
    public static function get($engine) {
      $contentID = $engine->getContentID();
      $calledView = get_called_class();

      if(static::$instances[$contentID][$calledView] === null)
        static::$instances[$contentID][$calledView] = new static($engine);
      return static::$instances[$contentID][$calledView];
    }

    /**
     * @return void
     */
    public function __destruct() {
      unset($this->view);
    }

    /**
     * @param $exec
     * @return void
     */
    public function execute($exec) {
      $method = 'exec'.$exec;
      if(is_callable(array($this, $method))):
        $this->$method();
      endif;
    }

    /**
     * @return integer
     */
    public function getContentID() {
      return $this->getEngine()->getContentID();
    }

    /**
     * @return \BB\engine\mvvm
     */
    public function getEngine() {
      return $this->engine;
    }

    /**
     * @return integer
     */
    public function getExtensionID() {
      return $this->getEngine()->getExtensionID();
    }

    /**
     * @return object
     */
    public function getLanguage() {
      return $this->getEngine()->lang;
    }

    /**
     * @return integer
     */
    public function getLanguageAbbreviation() {
      return $this->getLanguage()->abbreviation;
    }

    /**
     * @return integer
     */
    public function getLanguageID() {
      return $this->getEngine()->getLanguageID();
    }

    /**
     * @return integer
     */
    public function getMode() {
      return $this->getEngine()->getMode();
    }

    /**
     * @return integer
     */
    public function getPageID() {
      return $this->getEngine()->getPageID();
    }

    /**
     * @return integer
     */
    public function getTreeID() {
      return $this->getEngine()->getTreeID();
    }

    /**
     * @param $pathOfView
     * @return string
     */
    public function getView($pathOfView) {

      $this->view = new \BB\template\smarty($pathOfView);

      if(is_callable(array($this, 'view'))):
        static::view();
      endif;

      $html = $this->view->get();

      return $html;
    }
  }

?>