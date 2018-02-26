<?php

  namespace BB\custom\extension\efgettenheim\access\factory;
  
  /**
   * @package efgettenheim
   * @category Extension
   *
   * @method \BB\custom\extension\efgettenheim\access\object\staff getRow($contentID)
   * @method \BB\custom\extension\efgettenheim\access\object\staff[] getRows(array $contentIDs)
   * @method \BB\custom\extension\efgettenheim\access\object\staff[] searchRows(\BB\access\search $accessSearch, $fetchObjects = false)
   * @method \BB\custom\extension\efgettenheim\access\object\staff save(\BB\custom\extension\efgettenheim\access\object\staff $dto)
   * @method \BB\custom\extension\efgettenheim\access\field\*[] getFields()
   */
  class staff extends \BB\access\factory {
  
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
    protected $tableIdentifier = 'staff';
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
    	'staffFirstname',
    	'staffLastname',
    	'staffEmail',
    	'staffPassword',
    	'staffRights',
    	'staffRightModeratorManager',
    	'staffRightPreacherManager',
    	'staffRightWorshipManager',
    	'staffRightAudioEngineeringManager',
    	'staffRightSundaySchoolManager',
    	'staffRightReceptionManager',
    	'staffRightWorshipLeader',
    	'staffRightWorshipMusician',
    	'staffRightPreacher',
    	'staffRightModerator',
    	'staffRightAutioEngineer',
    	'staffRightSundaySchoolTeacher',
    	'staffRightReceptionist'
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