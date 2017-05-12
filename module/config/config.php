<?php

if (TL_MODE == 'BE') {
  $GLOBALS['TL_CSS'][] = 'system/modules/dz_backend/assets/pageshortcuts.css|screen';
  $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/dz_backend/assets/jquery.min.js';
  $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/dz_backend/assets/pageshortcuts.js';
}

$GLOBALS['pageshortcuts']['allowed_users'] = ['admin'];