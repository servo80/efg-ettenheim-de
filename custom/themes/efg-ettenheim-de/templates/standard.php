<?php

	namespace BB\custom\themes\efgettenheim;
	
	if(@secure !== true)
		die('forbidden');
	
	class standard {

		/**
		 * @param \BB\template\classic $pageTmpl
		 * @param $tree_id
		 * @param $lan_id
		 * @param array $page_ids
		 */
		public static function modeStage(\BB\template\classic $pageTmpl, $tree_id, $lan_id, $page_ids = array()) {

      $year = strftime('%Y');
      $pageTmpl->assign('year', $year > 2017 ? ' - '.$year : '');

      $modelContent = \BB\model\content::get();
      $image = $modelContent->getValue(5, 7, $page_ids[0], 1);

      if(!empty($image)):
        $pageTmpl->assign('pageImage', ' style="background-size:cover;background: url(../'.$image.' top;"');
      endif;
			
		}

		/**
		 * @param \BB\template\classic $pageTmpl
		 */
		protected function assignSlideShowImages($pageTmpl) {

			$slideShowDirectory = new \BB\directory('share/public/Slideshow');
			$slideShowImages = $slideShowDirectory->getFiles();

			$slideShowListElements = array();
			foreach($slideShowImages as $slideShowImage):
				$slideShowListElements[] = '<li><img src="image/1/'.$slideShowImage->path.'?w=980&h=255" alt=""></li>';
			endforeach;

			$pageTmpl->assign('slideShowImages', implode("\r\n", $slideShowListElements));

		}

		/*
		public static function modePage(\BB\template\classic $pageTmpl, $tree_id, $lan_id, $page_id) {
      $modelLanguage = \BB\model\language::get();
			$tree_id = (int)$tree_id;
			$lan_id = (int)$lan_id;
			$page_id = (int)$page_id;
      $pageTmpl->assign('lang', $modelLanguage->getLanguageAbbreviation($lan_id));
		}
		
		public static function modeMail(\BB\template\classic $pageTmpl, $tree_id, $lan_id, $page_id) {
			$tree_id = (int)$tree_id;
			$lan_id = (int)$lan_id;
			$page_id = (int)$page_id;
		}
		*/

	}
	
?>