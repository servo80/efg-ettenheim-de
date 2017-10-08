<?php

  namespace BB\custom\extension\efgettenheim;

  use BB\custom\extension\efgettenheim as efgettenheim;

  /**
   *
   */
  class engine extends \BB\engine\mvvm {

    /** @const string configNamespace */
    const configNamespace = '\BB\custom\extension\efgettenheim\\';

    /** @const string path */
    const configPath = 'custom/extension/efgettenheim/';

    /** @const string prefix */
    const configPrefix = 'efgettenheim';

    /** @const string configTemplateExtension */
    const configTemplateExtension = 'hbs';

    /** @const string patternPageViewLinks */
    const patternPageViewLinksAscii = '/{page:view(:file)?\[(.*?)\]}/i';

    /** @const string patternPageViewLinks */
    const patternPageViewLinksRfc = '/{page:view(:file)?%5B(.*?)%5D}/i';

    /**
     *
     */
    public function callableExec() {
    }

    /**
     *
     */
    public function callableView() {
      $this->parsePageViewLinks();
    }

    /**
     * @return \BB\template\classic
     */
    public function get() {

      try {

        $this->configMvvm();
        $this->callMvvm(
          array($this, 'callableExec'),
          array($this, 'callableView')
        );

      } catch(efgettenheim\lib\exception\mvvm $e) {

        $e->display();
        exit;

      }

      return $this->viewPage;
    }

    /**
     * @return string
     */
    public function getTheme() {
      return '';
    }

    /**
     * @return void
     */
    public function parsePageViewLinks() {
      $treeID = $this->getTreeID();
      $languageID = $this->getLanguageID();

      $html = $this->viewPage->getHtml();
      preg_match_all(self::patternPageViewLinksAscii, $html, $pageViews1);
      preg_match_all(self::patternPageViewLinksRfc, $html, $pageViews2);
      $pageViews = array_unique(array_merge($pageViews1[2], $pageViews2[2]));

      $modelPageview = lib\classes\pageview::get();

      foreach($pageViews as $pageview):
        $pageID = $modelPageview->getPageIDByView($pageview, $treeID, $languageID);

        $pageViewLink = $this->getLink($pageID, $this->mode);
        $pageViewFilename = $this->getPageFilename($pageID);

        $this->viewPage
          ->assign('page:view['.$pageview.']', $pageViewLink)
          ->assign('page:view%5B'.$pageview.'%5D', $pageViewLink)
          ->assign('page:view:file['.$pageview.']', $pageViewFilename)
          ->assign('page:view:file%5B'.$pageview.'%5D', $pageViewFilename)
        ;
      endforeach;

      if($this->mode != 'stage' && $this->mode != 'page' && $this->mode != 'mail'):
        $this->viewPage->replace('[?]', '&amp;');
      else:
        $this->viewPage->replace('[?]', '?');
      endif;
    }

    /**
     * @return boolean
     */
    public function isAuthenticated() {
      return false;
    }
  }

?>