<?php

  namespace BB\custom\extension\efgettenheim\access\object;
  
  /**
   * @package efgettenheim
   * @category Extension
   *
   * @method \BB\custom\extension\efgettenheim\access\object\service __construct(int $contentID, int $languageID = \BB\model\language::defaultID, int $userID = 0)
   * @method \BB\custom\extension\efgettenheim\access\object\service save()
   */
  class service extends \BB\access\object {
  
    /**
     * @var string $serviceDate
     */
    public $serviceDate;
    /**
     * @var string $serviceLabel
     */
    public $serviceLabel;
    /**
     * @var string $serviceAdditionalInfo
     */
    public $serviceAdditionalInfo;
    /**
     * @var string $serviceSermonTopic
     */
    public $serviceSermonTopic;
    /**
     * @var string $serviceSermonRecording
     */
    public $serviceSermonRecording;
    /**
     * @var integer $serviceModerator
     */
    public $serviceModerator;
    /**
     * @var integer $servicePreacher
     */
    public $servicePreacher;
    /**
     * @var integer $serviceWorshipLeader
     */
    public $serviceWorshipLeader;
    /**
     * @var integer $serviceSundaySchoolTeacherSmall
     */
    public $serviceSundaySchoolTeacherSmall;
    /**
     * @var integer $serviceSundaySchoolTeacherBig
     */
    public $serviceSundaySchoolTeacherBig;
    /**
     * @var integer $serviceAudioEngineer
     */
    public $serviceAudioEngineer;
    /**
     * @var integer $serviceReceptionist
     */
    public $serviceReceptionist;
    /**
     * @var string $serviceWorshipMusicians
     */
    public $serviceWorshipMusicians;
  }

?>