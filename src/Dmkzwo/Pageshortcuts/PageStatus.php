<?php


namespace Dmkzwo\Pageshortcuts;

class PageStatus extends \Backend {


  public function addToLabel($row, $label, $dc, $imageAttribute) {



    $newLabel = $label;

    if ($row['pid'] != '0') {

      $newLabel .= ' <a href="javascript:;" onclick="dzToggleSearch('.$row['id'].');$j(this).toggleClass(\'search\');$j(this).toggleClass(\'nosearch\');" class="'.(($row['noSearch'] == 1) ? 'no' : '').'search">s</a>';

      //$newLabel .= ' <a href="javascript:;" onclick="dzToggleSitemap('.$row['id'].');$j(this).toggleClass(\'sitemap\');$j(this).toggleClass(\'nositemap\');" class="'.(($row['sitemap_ignore'] == 1) ? 'no' : '').'sitemap">xml</a>';

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


    }

    $this->import("tl_page");
    return $this->tl_page->addIcon($row, $newLabel, $dc, $imageAttribute);

  }

}