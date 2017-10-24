<?php

  namespace BB\custom\extension\databaseObjects\classes;

  /**
   * @author Philipp Frick <frick@konmedia.com>
   * @date 11.09.2017
   */
  class printingSearch extends \BB\access\search {

    /**
     * @param int $companyID
     * @param array $printingIDs
     * @param int $languageID
     */
    public function __construct() {
    }

    /**
     *
     */
    protected function build() {
      $fieldset = new \BB\access\conditionFieldset();
      $fieldset->add($this->getConditionCompanyID());
      #$fieldset->add($this->getConditionInPrintingIDs());
      $fieldset->add(new \BB\access\conditionAnd());
      $this->add($fieldset);
    }

    /**
     * @return \BB\access\conditionField
     */
    protected function getConditionCompanyID() {
      $field = new \BB\access\conditionField();
      $field->id(\BB\custom\extension\efgettenheim\access\field\de\eventDate::class)
        ->isGreaterThan(time())
        ->sortAsc();

      return $field;
    }

  }



?>