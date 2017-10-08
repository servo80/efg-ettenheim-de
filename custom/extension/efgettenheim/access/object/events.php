<?php

  namespace BB\custom\extension\efgettenheim\access\object;
  
  /**
   * @package efgettenheim
   * @category Extension
   *
   * @method \BB\custom\extension\efgettenheim\access\object\events __construct(int $contentID, int $languageID = \BB\model\language::defaultID, int $userID = 0)
   * @method \BB\custom\extension\efgettenheim\access\object\events save()
   */
  class events extends \BB\access\object {
  
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
  }

?>