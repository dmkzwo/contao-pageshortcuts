<?php

namespace Dmkzwo\Pageshortcuts;

class PageMeta extends \Backend {


  public function addListFunctions($row, $label, $dc, $imageAttribute) {
  
    $newLabel = $label;
    
    $newLabel .= ' <a href="javascript:;" onclick="dzToggleSearch('.$row['id'].');$j(this).toggleClass(\'search\');$j(this).toggleClass(\'nosearch\');" class="'.(($row['noSearch'] == 1) ? 'no' : '').'search">s</a>';
    $newLabel .= ' <a href="javascript:;" onclick="dzToggleSitemap('.$row['id'].');$j(this).toggleClass(\'sitemap\');$j(this).toggleClass(\'nositemap\');" class="'.(($row['sitemap_ignore'] == 1) ? 'no' : '').'sitemap">xml</a>';
      
    if (strlen($row['robots'])) {
      $robots = explode(',', $row['robots']);
      $newLabel .= ' <a href="javascript:;" onclick="dzToggleIndex('.$row['id'].');$j(this).toggleClass(\'index\');$j(this).toggleClass(\'noindex\');" class="'.$robots[0].'">i</a>';
      $newLabel .=  '<a href="javascript:;" onclick="dzToggleFollow('.$row['id'].');$j(this).toggleClass(\'follow\');$j(this).toggleClass(\'nofollow\');" class="'.$robots[1].'">f</a>';
    }
  
    if ($row['includeCache']) {
      $newLabel .= ' <a href="javascript:;" onclick="dzToggleCache('.$row['id'].', $j(this));" class="'.(($row['cache'] == 0) ? 'no' : '').'cache">'.(($row['cache'] == 0) ? 'nc' : $row['cache']).'</a>';
    } else {
      $newLabel .= ' <a href="javascript:;" onclick="dzToggleCache('.$row['id'].', $j(this));" class="parentcache">--</a>';
    }

    $this->import("tl_page");        
    return $this->tl_page->addIcon($row, $newLabel, $dc, $imageAttribute);
  
  }

  
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
    
		$objPage = $this->Database->prepare("UPDATE tl_page SET robots=? WHERE id=?")
									 ->execute($newRobots, $pageId);
    
  
  }

  
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
    
		$objPage = $this->Database->prepare("UPDATE tl_page SET robots=? WHERE id=?")
									 ->execute($newRobots, $pageId);
    
  
  }
  
  public function toggleCache($pageId) {
  
		$objPage = $this->Database->prepare("SELECT * FROM tl_page WHERE id=?")
									 ->limit(1)
									 ->execute($pageId);

		if ($objPage->numRows < 1) {
			return false;
		}
    
    $includeCache = $objPage->includeCache;
    $cache = $objPage->cache;
    
    if ($includeCache == '') {
      $includeCache = '1';
      $cache = '0';
      //if ($cache == '0') {
      //  $cache = '60';
      //}
    } else {
      if ($cache == '0') {
        $cache = '60';
      } else {
        $includeCache = '';
      }
    }
    
		$objPage = $this->Database->prepare("UPDATE tl_page SET includeCache=?, cache=? WHERE id=?")
									 ->execute($includeCache, $cache, $pageId);
                   
    $output = array('includeCache' => $includeCache, 'cache' => $cache);

    return json_encode($output);
    
  
  }

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
    
		$objPage = $this->Database->prepare("UPDATE tl_page SET noSearch=? WHERE id=?")
									 ->execute($noSearch, $pageId);
    
  
  }
  
  public function toggleSitemap($pageId) {
  
		$objPage = $this->Database->prepare("SELECT * FROM tl_page WHERE id=?")
									 ->limit(1)
									 ->execute($pageId);

		if ($objPage->numRows < 1) {
			return false;
		}
    
    $sitemap_ignore = $objPage->sitemap_ignore;
    
    if ($sitemap_ignore == '1') {
      $sitemap_ignore = '';
    } else {
      $sitemap_ignore = '1';
    }
    
		$objPage = $this->Database->prepare("UPDATE tl_page SET sitemap_ignore=? WHERE id=?")
									 ->execute($sitemap_ignore, $pageId);
    
  
  }
  

  
}

?>