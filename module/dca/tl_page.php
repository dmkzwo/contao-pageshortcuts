<?php

// List label callbacks
$this->import('BackendUser', 'User');

if ( (!$GLOBALS['pageshortcuts']['allowed_users'] || in_array($this->User->username, $GLOBALS['pageshortcuts']['allowed_users']))
  && ($this->Input->get('do') == 'page')) {
    $GLOBALS['TL_DCA']['tl_page']['list']['label']['label_callback'] = array(
      'Dmkzwo\\Pageshortcuts\\PageStatus',
      'addToLabel'
    );
}

