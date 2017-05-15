<?php

namespace Dmkzwo\Pageshortcuts;

/**
 * Class PageStatus
 *
 * @copyright  DMKZWO GmbH 2017
 * @author     Thomas Schabacher
 * @package    Pageshortcuts
 */
class PageStatus extends \Backend {


  /**
   * adds links to label
   * @param array $row
   * @param string $label
   * @param DataContainer $dc
   * @param string $imageAttribute
   * @return string
   */
  public function addToLabel($row, $label, $dc, $imageAttribute) {

    $newLabel = $label;

    if ($row['pid'] != '0') {

      $newLabel .= ' <a href="javascript:;" onclick="dzToggleSearch('.$row['id'].');$j(this).toggleClass(\'search\');$j(this).toggleClass(\'nosearch\');" class="'.(($row['noSearch'] == 1) ? 'no' : '').'search">s</a>';

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