<?php

  namespace BB\custom\extension\efgettenheim\access\factory;
  
  /**
   * @package efgettenheim
   * @category Extension
   *
   * @method \BB\custom\extension\efgettenheim\access\object\songBook getRow($contentID)
   * @method \BB\custom\extension\efgettenheim\access\object\songBook[] getRows(array $contentIDs)
   * @method \BB\custom\extension\efgettenheim\access\object\songBook[] searchRows(\BB\access\search $accessSearch, $fetchObjects = false)
   * @method \BB\custom\extension\efgettenheim\access\object\songBook save(\BB\custom\extension\efgettenheim\access\object\songBook $dto)
   * @method \BB\custom\extension\efgettenheim\access\field\*[] getFields()
   */
  class songBook extends \BB\access\factory {
  
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
    protected $tableIdentifier = 'songBook';
    /**
     * @var array
     */
    protected $parentTableIdentifier = array(
    	
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
    	'songBookTitle'
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