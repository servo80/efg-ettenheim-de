<?php

  namespace BB\custom\extension\efgettenheim\access\object;
  
  /**
   * @package efgettenheim
   * @category Extension
   *
   * @method \BB\custom\extension\efgettenheim\access\object\staff __construct(int $contentID, int $languageID = \BB\model\language::defaultID, int $userID = 0)
   * @method \BB\custom\extension\efgettenheim\access\object\staff save()
   */
  class staff extends \BB\access\object {
  
    /**
     * @var string $staffFirstname
     */
    public $staffFirstname;
    /**
     * @var string $staffLastname
     */
    public $staffLastname;
    /**
     * @var string $staffEmail
     */
    public $staffEmail;
    /**
     * @var string $staffPassword
     */
    public $staffPassword;
    /**
     * @var integer $staffRights
     */
    public $staffRights;
    /**
     * @var boolean $staffRightModeratorManager
     */
    public $staffRightModeratorManager;
    /**
     * @var boolean $staffRightPreacherManager
     */
    public $staffRightPreacherManager;
    /**
     * @var boolean $staffRightWorshipManager
     */
    public $staffRightWorshipManager;
    /**
     * @var boolean $staffRightAudioEngineeringManager
     */
    public $staffRightAudioEngineeringManager;
    /**
     * @var boolean $staffRightSundaySchoolManager
     */
    public $staffRightSundaySchoolManager;
    /**
     * @var boolean $staffRightReceptionManager
     */
    public $staffRightReceptionManager;
    /**
     * @var boolean $staffRightWorshipLeader
     */
    public $staffRightWorshipLeader;
    /**
     * @var integer $staffRightWorshipMusician
     */
    public $staffRightWorshipMusician;
    /**
     * @var boolean $staffRightPreacher
     */
    public $staffRightPreacher;
    /**
     * @var boolean $staffRightModerator
     */
    public $staffRightModerator;
    /**
     * @var boolean $staffRightAutioEngineer
     */
    public $staffRightAutioEngineer;
    /**
     * @var boolean $staffRightSundaySchoolTeacher
     */
    public $staffRightSundaySchoolTeacher;
    /**
     * @var boolean $staffRightReceptionist
     */
    public $staffRightReceptionist;
  }

?>