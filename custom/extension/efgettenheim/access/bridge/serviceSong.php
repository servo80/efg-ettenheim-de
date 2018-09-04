<?php

  namespace BB\custom\extension\efgettenheim\access\bridge;
  
  /**
   * @package efgettenheim
   * @category Extension
   */
  class serviceSong extends \BB\access\bridge {
  
    /**
     * @var self $instances
     */
    public static $instances = array(
    	
    );
    /**
     * @var string
     */
    public $labelParentFactory = 'BB\custom\extension\efgettenheim\access\factory\service';
    /**
     * @var string
     */
    public $labelChildFactory = 'BB\custom\extension\efgettenheim\access\factory\song';
    /**
     * @param int $languageID
     * @return self|\BB\access\bridge
     */
    public static function get($languageID = \BB\model\language::defaultID) {
      return parent::get($languageID);
    }
    
    /**
     * @var int $songID
     * @return \BB\access\object | \BB\custom\extension\efgettenheim\access\object\service
     */
    public function getServiceRow($songID) {
      return parent::getFirstParent($songID);
    }
    
    /**
     * @var int $songID
     * @return \BB\access\object | \BB\custom\extension\efgettenheim\access\object\service[]
     */
    public function getServiceRows($songID) {
      return parent::getParents($songID);
    }
    
    /**
     * @var int $serviceID
     * @return \BB\access\object | \BB\custom\extension\efgettenheim\access\object\song
     */
    public function getSongRow($serviceID) {
      return parent::getFirstChild($serviceID);
    }
    
    /**
     * @var int $serviceID
     * @return \BB\access\object | \BB\custom\extension\efgettenheim\access\object\song[]
     */
    public function getSongRows($serviceID) {
      return parent::getChildren($serviceID);
    }
  }

?>