<?php

  namespace BB\custom\extension\efgettenheim\access\field\de;
  
  /**
   * @package efgettenheim
   * @category Extension
   */
  class staffRights extends \BB\access\field {
  
    /**
     * @var string $fieldID
     */
    protected $fieldID = 'staffRights';
    /**
     * @var string
     */
    protected $ns = 'BB\custom\extension\efgettenheim\access\field';
    /**
     * @var string $name
     */
    protected $name = 'Rechte';
    /**
     * @var string $description
     */
    protected $description = '';
    /**
     * @var string $type
     */
    protected $type = 'int';
    /**
     * @var int $length
     */
    protected $length = 0;
    /**
     * @var string $form
     */
    protected $form = 'f_id_group';
    /**
     * @var string $unit
     */
    protected $unit = '';
    /**
     * @var string $default
     */
    protected $default = '';
    /**
     * @var array $entries
     */
    protected $entries = array(
    	
    );
    /**
     * @var string $source
     */
    protected $source = '';
    /**
     * @var string $relationFieldID
     */
    protected $relationFieldID = '';
    /**
     * @var int $width
     */
    protected $width = 0;
    /**
     * @var int $height
     */
    protected $height = 0;
    /**
     * @var boolean $isSearchable
     */
    protected $isSearchable = false;
    /**
     * @var boolean $isResult
     */
    protected $isResult = false;
    /**
     * @var boolean $isIdentifiable
     */
    protected $isIdentifiable = false;
    /**
     * @var boolean $isIdentifiablePerson
     */
    protected $isIdentifiablePerson = false;
    /**
     * @var boolean $isIdentifiableFile
     */
    protected $isIdentifiableFile = false;
    /**
     * @var boolean $isMonolingual
     */
    protected $isMonolingual = false;
    /**
     * @var boolean $isRequired
     */
    protected $isRequired = false;
    /**
     * @var boolean $appendToMail
     */
    protected $appendToMail = false;
    /**
     * @var array $groupFieldIDs
     */
    protected $groupFieldIDs = array(
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
     * @var string $css
     */
    protected $css = '';
  }

?>