<?php

  namespace BB\custom\extension\efgettenheim\lib\classes;

  /**
   *
   */
  class pageview extends \BB\custom\extension\efgettenheim\lib\classes\pattern\singleton {

    const tableID = \BB\model\page::tableID;
    protected static $instance = null;

    private $cachePageIDsByView = array();

    /**
     * @return self
     */
    public static function get() {
      return parent::get();
    }

    /**
     * @param int $treeID
     * @param int $languageID
     * @param array $pageIDs
     * @return array
     */
    public function getFilteredPageIDs($treeID, $languageID, $pageIDs) {
      $pageIDs = (array)$pageIDs;

      if(!empty($pageIDs)):
        $db = \BB\db::get();
        $pageIDs = $db->rows(
          ' SELECT page_id'.
          ' FROM brandbox_web_pages'.
          ' WHERE page_tree_id = '.$treeID.
            ' AND page_lan_id = '.$languageID.
            ' AND page_id IN('.implode(',', $pageIDs).')',
          null,
          'page_id'
        );
      endif;

      return $pageIDs;
    }

    /**
     * @param $view
     * @param $treeID
     * @param $languageID
     * @return string
     */
    public function getPageIDByView($view, $treeID, $languageID) {
      $treeID = (int)$treeID;
      $languageID = (int)$languageID;

      if(isset($this->cachePageIDsByView[$treeID][$languageID]))
        return $this->cachePageIDsByView[$treeID][$languageID][$view];

      $pageIDs = $this->getPageIDsByPageview($languageID);
      $pageIDs = $this->getFilteredPageIDs($treeID, $languageID, $pageIDs);

      $this->setCacheOfPageviews($pageIDs, $languageID);

      foreach($pageIDs as $pageID):
        $pageview = $this->getPageview($pageID, $languageID);
        $this->cachePageIDsByView[$treeID][$languageID][$pageview] = $pageID;
      endforeach;


      return $this->cachePageIDsByView[$treeID][$languageID][$view];
    }

    /**
     * @param $languageID
     * @return string
     */
    public function getPageIDsUsingAView($languageID) {
      $languageID = (int)$languageID;

      $searchResult = $this->modelContent->execSearch(
        array(
          'languageID' => $languageID,
          'tableID'    => self::tableID,
          'fields'     => array('pageview','!= ""', \BB\model\content::searchIn),
          'offset'     => 0,
          'limit'      => 100
        )
      );

      return $searchResult->contentIDs;
    }

    /**
     * @param $pageID
     * @param $languageID
     * @return string
     */
    public function getPageview($pageID, $languageID) {
      $pageID = (int)$pageID;
      $languageID = (int)$languageID;
      $value = $this->modelContent->getValue(self::tableID, 'pageview', $pageID, $languageID);

      return $value;
    }

    /**
     * @param $pageIDs
     * @param $languageID
     */
    public function setCacheOfPageviews($pageIDs, $languageID) {
      $this->modelContent->setCacheOfDatasets(
        self::tableID,
        $pageIDs,
        array('pageview'),
        $languageID
      );
    }

    /**
     * @param int $languageID
     * @return array
     */
    private function getPageIDsByPageview($languageID) {

      $conditionPageview = new \BB\access\conditionField();
      $conditionPageview->id('pageview')->isNot('');

      $searchResult = $this->modelContent->execSearch(
        array(
          'languageID' => $languageID,
          'tableID'    => self::tableID,
          'fields'     => $conditionPageview->get(),
          'offset'     => 0,
          'limit'      => 100
        )
      );

      return $searchResult->contentIDs;
    }
  }

?>