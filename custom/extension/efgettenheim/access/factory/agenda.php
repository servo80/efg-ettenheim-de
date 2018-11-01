<?php

  namespace BB\custom\extension\efgettenheim\access\factory;
  
  /**
   * @package efgettenheim
   * @category Extension
   *
   * @method \BB\custom\extension\efgettenheim\access\object\agenda getRow($contentID)
   * @method \BB\custom\extension\efgettenheim\access\object\agenda[] getRows(array $contentIDs)
   * @method \BB\custom\extension\efgettenheim\access\object\agenda[] searchRows(\BB\access\search $accessSearch, $fetchObjects = false)
   * @method \BB\custom\extension\efgettenheim\access\object\agenda save(\BB\custom\extension\efgettenheim\access\object\agenda $dto)
   * @method \BB\custom\extension\efgettenheim\access\field\*[] getFields()
   */
  class agenda extends \BB\access\factory {
  
    /**
     * @var self $instances
     */
    public static $instances = array(
    	
    );
    /**
     * @var int
     */
    protected $tableID = 0;
    /**
     * @var string
     */
    protected $tableIdentifier = 'agenda';
    /**
     * @var array
     */
    protected $parentTableIdentifier = array(
    	'service'
    );
    /**
     * @var array
     */
    protected $childTableIdentifier = array(
    	
    );
    /**
     * @var string
     */
    protected $ns = 'BB\custom\extension\efgettenheim\access';
    /**
     * @var array
     */
    protected $fields = array(
    	'agendaSong',
    	'agendaTitle',
    	'agendaRemarks',
    	'agendaResponsible'
    );
    /**
     * @param int $languageID
     * @return self|\BB\access\factory
     */
    public static function get($languageID = \BB\model\language::defaultID) {
      return parent::get($languageID);
    }
  }

?>