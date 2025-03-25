<?php

if (!defined("nichan")):
    Redirect::to($site->url.'/404');
endif;

if (!$user->isLoggedIn()):
    Redirect::to($site->url.'/login');
endif;

require './views/themes/nichan/layout/header/content.php';
require './views/themes/nichan/layout/settings/content.php';
require './views/themes/nichan/layout/footer/content.php';

?>