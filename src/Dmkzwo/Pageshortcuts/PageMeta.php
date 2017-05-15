<?php

namespace Dmkzwo\Pageshortcuts;

/**
 * Class PageMeta
 *
 * @copyright  DMKZWO GmbH 2017
 * @author     Thomas Schabacher
 * @package    Pageshortcuts
 */
class PageMeta extends \Backend {

  /**
   * toggle index setting
   * @param integer $pageId
   * @return boolean
   */
  public function toggleIndex($pageId) {
  
		$objPage = $this->Database->prepare("SELECT * FROM tl_page WHERE id=?")
									 ->limit(1)
									 ->execute($pageId);

		if ($objPage->numRows < 1) {
			return false;
		}
    
    $robots = $objPage->robots;
    
    if (($robots == 'index,follow') || ($robots == 'index,nofollow')) {
      $newRobots = str_replace('index', 'noindex', $robots);
    }
    if (($robots == 'noindex,follow') || ($robots == 'noindex,nofollow')) {
      $newRobots = str_replace('noindex', 'index', $robots);
    }
    
		$this->Database->prepare("UPDATE tl_page SET robots=? WHERE id=?")
									 ->execute($newRobots, $pageId);

    return true;
  
  }

  /**
   * toggle follow setting
   * @param integer $pageId
   * @return boolean
   */
  public function toggleFollow($pageId) {
  
		$objPage = $this->Database->prepare("SELECT * FROM tl_page WHERE id=?")
									 ->limit(1)
									 ->execute($pageId);

		if ($objPage->numRows < 1) {
			return false;
		}
    
    $robots = $objPage->robots;
    
    if (($robots == 'index,follow') || ($robots == 'noindex,follow')) {
      $newRobots = str_replace('follow', 'nofollow', $robots);
    }
    if (($robots == 'index,nofollow') || ($robots == 'noindex,nofollow')) {
      $newRobots = str_replace('nofollow', 'follow', $robots);
    }
    
		$this->Database->prepare("UPDATE tl_page SET robots=? WHERE id=?")
									 ->execute($newRobots, $pageId);

    return true;

  }

  /**
   * toggle cache setting
   * @param integer $pageId
   * @return string
   */
  public function toggleCache($pageId) {
  
		$objPage = $this->Database->prepare("SELECT * FROM tl_page WHERE id=?")
									 ->limit(1)
									 ->execute($pageId);

		if ($objPage->numRows < 1) {
			return '';
		}
    
    $includeCache = $objPage->includeCache;
    $cache = $objPage->cache;
    
    if ($includeCache == '') {
      $includeCache = '1';
      $cache = '0';
    } else {
      if ($cache == '0') {
        $cache = '60';
      } else {
        $includeCache = '';
      }
    }
    
		$this->Database->prepare("UPDATE tl_page SET includeCache=?, cache=? WHERE id=?")
									 ->execute($includeCache, $cache, $pageId);
                   
    $output = array('includeCache' => $includeCache, 'cache' => $cache);

    return json_encode($output);
    
  
  }


  /**
   * toggle search setting
   * @param integer $pageId
   * @return boolean
   */
  public function toggleSearch($pageId) {
  
		$objPage = $this->Database->prepare("SELECT * FROM tl_page WHERE id=?")
									 ->limit(1)
									 ->execute($pageId);

		if ($objPage->numRows < 1) {
			return false;
		}
    
    $noSearch = $objPage->noSearch;
    
    if ($noSearch == '1') {
      $noSearch = '';
    } else {
      $noSearch = '1';
    }
    
		$this->Database->prepare("UPDATE tl_page SET noSearch=? WHERE id=?")
									 ->execute($noSearch, $pageId);

    return true;
  
  }
  

}

?>