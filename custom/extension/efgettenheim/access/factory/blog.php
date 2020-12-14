<?php

  namespace BB\custom\extension\efgettenheim\access\factory;
  
  /**
   * @package efgettenheim
   * @category Extension
   *
   * @method \BB\custom\extension\efgettenheim\access\object\blog getRow($contentID)
   * @method \BB\custom\extension\efgettenheim\access\object\blog[] getRows(array $contentIDs)
   * @method \BB\custom\extension\efgettenheim\access\object\blog[] searchRows(\BB\access\search $accessSearch, $fetchObjects = false)
   * @method \BB\custom\extension\efgettenheim\access\object\blog save(\BB\custom\extension\efgettenheim\access\object\blog $dto)
   * @method \BB\custom\extension\efgettenheim\access\field\*[] getFields()
   */
  class blog extends \BB\access\factory {
  
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
    protected $tableIdentifier = 'blog';
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
    	'eventDate',
    	'eventHeadline',
    	'eventText',
    	'eventLink',
    	'eventImage'
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