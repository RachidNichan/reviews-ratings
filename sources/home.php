<?php

if (!defined("nichan")):
    Redirect::to($site->url.'/404');
endif;

$main_categories = new Review();

require './views/themes/nichan/layout/header/content.php';
require './views/themes/nichan/layout/home/content.php';
require './views/themes/nichan/layout/footer/content.php';

?>