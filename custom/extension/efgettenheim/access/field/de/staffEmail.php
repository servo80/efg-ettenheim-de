<?php

  namespace BB\custom\extension\efgettenheim\access\field\de;
  
  /**
   * @package efgettenheim
   * @category Extension
   */
  class staffEmail extends \BB\access\field {
  
    /**
     * @var string $fieldID
     */
    protected $fieldID = 'staffEmail';
    /**
     * @var string
     */
    protected $ns = 'BB\custom\extension\efgettenheim\access\field';
    /**
     * @var string $name
     */
    protected $name = 'E-Mail-Adresse';
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
    protected $length = 50;
    /**
     * @var string $form
     */
    protected $form = 'username';
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