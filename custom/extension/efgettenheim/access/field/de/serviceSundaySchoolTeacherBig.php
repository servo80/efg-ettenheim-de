<?php

  namespace BB\custom\extension\efgettenheim\access\field\de;
  
  /**
   * @package efgettenheim
   * @category Extension
   */
  class serviceSundaySchoolTeacherBig extends \BB\access\field {
  
    /**
     * @var string $fieldID
     */
    protected $fieldID = 'serviceSundaySchoolTeacherBig';
    /**
     * @var string
     */
    protected $ns = 'BB\custom\extension\efgettenheim\access\field';
    /**
     * @var string $name
     */
    protected $name = 'Sonntagsschule groß';
    /**
     * @var string $description
     */
    protected $description = '';
    /**
     * @var string $type
     */
    protected $type = 'varchar';
    /**
     * @var int $length
     */
    protected $length = 20;
    /**
     * @var string $form
     */
    protected $form = 'cn_ids';
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
    protected $relationFieldID = 'staff:staffEmail';
    /**
     * @var int $width
     */
    protected $width = 300;
    /**
     * @var int $height
     */
    protected $height = 1;
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
    protected $isMonolingual = true;
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
    	
    );
    /**
     * @var string $css
     */
    protected $css = '';
  }

?>