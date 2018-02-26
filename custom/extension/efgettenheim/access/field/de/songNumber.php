<?php

  namespace BB\custom\extension\efgettenheim\access\field\de;
  
  /**
   * @package efgettenheim
   * @category Extension
   */
  class songNumber extends \BB\access\field {
  
    /**
     * @var string $fieldID
     */
    protected $fieldID = 'songNumber';
    /**
     * @var string
     */
    protected $ns = 'BB\custom\extension\efgettenheim\access\field';
    /**
     * @var string $name
     */
    protected $name = 'Liednummer';
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
    protected $length = 10;
    /**
     * @var string $form
     */
    protected $form = 'input';
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
    protected $width = 100;
    /**
     * @var int $height
     */
    protected $height = 1;
    /**
     * @var boolean $isSearchable
     */
    protected $isSearchable = true;
    /**
     * @var boolean $isResult
     */
    protected $isResult = true;
    /**
     * @var boolean $isIdentifiable
     */
    protected $isIdentifiable = true;
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
    	
    );
    /**
     * @var string $css
     */
    protected $css = '';
  }

?>