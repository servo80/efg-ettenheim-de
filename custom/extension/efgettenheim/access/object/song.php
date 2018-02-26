<?php

  namespace BB\custom\extension\efgettenheim\access\object;
  
  /**
   * @package efgettenheim
   * @category Extension
   *
   * @method \BB\custom\extension\efgettenheim\access\object\song __construct(int $contentID, int $languageID = \BB\model\language::defaultID, int $userID = 0)
   * @method \BB\custom\extension\efgettenheim\access\object\song save()
   */
  class song extends \BB\access\object {
  
    /**
     * @var string $songTitle
     */
    public $songTitle;
    /**
     * @var integer $songBook
     */
    public $songBook;
    /**
     * @var integer $songNumber
     */
    public $songNumber;
    /**
     * @var string $songCopyRight
     */
    public $songCopyRight;
  }

?>