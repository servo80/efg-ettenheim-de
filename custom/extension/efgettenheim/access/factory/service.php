<?php

  namespace BB\custom\extension\efgettenheim\access\factory;
  
  /**
   * @package efgettenheim
   * @category Extension
   *
   * @method \BB\custom\extension\efgettenheim\access\object\service getRow($contentID)
   * @method \BB\custom\extension\efgettenheim\access\object\service[] getRows(array $contentIDs)
   * @method \BB\custom\extension\efgettenheim\access\object\service[] searchRows(\BB\access\search $accessSearch, $fetchObjects = false)
   * @method \BB\custom\extension\efgettenheim\access\object\service save(\BB\custom\extension\efgettenheim\access\object\service $dto)
   * @method \BB\custom\extension\efgettenheim\access\field\*[] getFields()
   */
  class service extends \BB\access\factory {
  
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
    protected $tableIdentifier = 'service';
    /**
     * @var array
     */
    protected $parentTableIdentifier = array(
    	
    );
    /**
     * @var array
     */
    protected $childTableIdentifier = array(
    	'agenda',
    	'song'
    );
    /**
     * @var string
     */
    protected $ns = 'BB\custom\extension\efgettenheim\access';
    /**
     * @var array
     */
    protected $fields = array(
    	'serviceDate',
    	'serviceLabel',
    	'serviceAdditionalInfo',
    	'serviceSermonTopic',
    	'serviceSermonRecording',
    	'serviceModerator',
    	'servicePreacher',
    	'serviceWorshipLeader',
    	'serviceSundaySchoolTeacherSmall',
    	'serviceSundaySchoolTeacherBig',
    	'serviceAudioEngineer',
    	'serviceReceptionist',
    	'serviceWorshipMusicians'
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