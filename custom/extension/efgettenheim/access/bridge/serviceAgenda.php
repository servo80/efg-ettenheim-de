<?php

  namespace BB\custom\extension\efgettenheim\access\bridge;
  
  /**
   * @package efgettenheim
   * @category Extension
   */
  class serviceAgenda extends \BB\access\bridge {
  
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
    public $labelChildFactory = 'BB\custom\extension\efgettenheim\access\factory\agenda';
    /**
     * @param int $languageID
     * @return self|\BB\access\bridge
     */
    public static function get($languageID = \BB\model\language::defaultID) {
      return parent::get($languageID);
    }
    
    /**
     * @var int $agendaID
     * @return \BB\access\object | \BB\custom\extension\efgettenheim\access\object\service
     */
    public function getServiceRow($agendaID) {
      return parent::getFirstParent($agendaID);
    }
    
    /**
     * @var int $agendaID
     * @return \BB\access\object | \BB\custom\extension\efgettenheim\access\object\service[]
     */
    public function getServiceRows($agendaID) {
      return parent::getParents($agendaID);
    }
    
    /**
     * @var int $serviceID
     * @return \BB\access\object | \BB\custom\extension\efgettenheim\access\object\agenda
     */
    public function getAgendaRow($serviceID) {
      return parent::getFirstChild($serviceID);
    }
    
    /**
     * @var int $serviceID
     * @return \BB\access\object | \BB\custom\extension\efgettenheim\access\object\agenda[]
     */
    public function getAgendaRows($serviceID) {
      return parent::getChildren($serviceID);
    }
  }

?>