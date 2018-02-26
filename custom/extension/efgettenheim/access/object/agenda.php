<?php

  namespace BB\custom\extension\efgettenheim\access\object;
  
  /**
   * @package efgettenheim
   * @category Extension
   *
   * @method \BB\custom\extension\efgettenheim\access\object\agenda __construct(int $contentID, int $languageID = \BB\model\language::defaultID, int $userID = 0)
   * @method \BB\custom\extension\efgettenheim\access\object\agenda save()
   */
  class agenda extends \BB\access\object {
  
    /**
     * @var integer $agendaSong
     */
    public $agendaSong;
    /**
     * @var string $agendaTitle
     */
    public $agendaTitle;
    /**
     * @var string $agendaRemarks
     */
    public $agendaRemarks;
  }

?>