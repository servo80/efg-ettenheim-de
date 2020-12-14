<?php

  namespace BB\custom\extension\efgettenheim\access\object;
  
  /**
   * @package efgettenheim
   * @category Extension
   *
   * @method \BB\custom\extension\efgettenheim\access\object\blog __construct(int $contentID, int $languageID = \BB\model\language::defaultID, int $userID = 0)
   * @method \BB\custom\extension\efgettenheim\access\object\blog save()
   */
  class blog extends \BB\access\object {
  
    /**
     * @var string $eventDate
     */
    public $eventDate;
    /**
     * @var string $eventHeadline
     */
    public $eventHeadline;
    /**
     * @var string $eventText
     */
    public $eventText;
    /**
     * @var integer $eventLink
     */
    public $eventLink;
    /**
     * @var string $eventImage
     */
    public $eventImage;
  }

?>