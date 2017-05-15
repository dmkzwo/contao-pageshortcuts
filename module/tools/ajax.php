<?php

define('TL_MODE', 'BE');

require($_SERVER["DOCUMENT_ROOT"].'/system/initialize.php');


/**
 * Class BackendAjax
 *
 * @copyright  DMKZWO GmbH 2017
 * @author     Thomas Schabacher
 * @package    Pageshortcuts
 */
class BackendAjax extends Backend {

	public function __construct()	{
	}


	/**
	 * Run the controller
	 */
	public function run() {

    $mode = $_GET['mode'];
    $pageId = $_GET['id'];

    if (!$this->checkPermission($pageId)) {
      return;
    }


		if ($mode != '') {

      $pageMeta = new \Dmkzwo\Pageshortcuts\PageMeta();

      if ($mode == 'toggleindex') {
        $pageMeta->toggleIndex($pageId);
      }
    
      if ($mode == 'togglefollow') {
        $pageMeta->toggleFollow($pageId);
      }
    
      if ($mode == 'togglecache') {
        echo $pageMeta->toggleCache($pageId);
      }
    
      if ($mode == 'togglesearch') {
        $pageMeta->toggleSearch($pageId);
      }
    
      if ($mode == 'togglesitemap') {
        $pageMeta->toggleSitemap($pageId);
      }
    
    }
    
	}


  /**
   * check page permissions
   * @param int $pageId
   * @return boolean
   */
	protected function checkPermission($pageId) {

	  $this->import('Database');
    $this->import('BackendUser', 'User');

    $objPage = $this->Database->prepare("SELECT * FROM tl_page WHERE id=?")
      ->limit(1)
      ->execute($pageId);

    if ($objPage->numRows < 1) {
      return false;
    }

    $permission = \BackendUser::CAN_EDIT_PAGE;

    if (!$this->User->isAllowed($permission, $objPage->row())) {
      return false;
    }

    return true;

  }
	
}


/**
 * Instantiate controller
 */
$objBackendAjax = new BackendAjax();
$objBackendAjax->run();

