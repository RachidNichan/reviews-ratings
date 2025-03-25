<?php

if (!defined("nichan")):
    Redirect::to($site->url.'/404');
endif;

require './views/themes/nichan/layout/header/content.php';
require './views/themes/nichan/layout/404/content.php';
require './views/themes/nichan/layout/footer/content.php';

?>