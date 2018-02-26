<?php

  namespace BB\custom\extension\efgettenheim\access\object;
  
  /**
   * @package efgettenheim
   * @category Extension
   *
   * @method \BB\custom\extension\efgettenheim\access\object\songBook __construct(int $contentID, int $languageID = \BB\model\language::defaultID, int $userID = 0)
   * @method \BB\custom\extension\efgettenheim\access\object\songBook save()
   */
  class songBook extends \BB\access\object {
  
    /**
     * @var string $songBookTitle
     */
    public $songBookTitle;
  }

?>