<?php

if (TL_MODE == 'BE') {
  $GLOBALS['TL_CSS'][] = 'system/modules/pageshortcuts/assets/pageshortcuts.css|screen';
  $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/pageshortcuts/assets/jquery.min.js';
  $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/pageshortcuts/assets/pageshortcuts.js';
}

$GLOBALS['pageshortcuts']['allowed_users'] = ['admin'];