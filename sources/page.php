<?php

if (!defined("nichan")):
    Redirect::to($site->url.'/404');
endif;

$custom_page = new CustomPage(Input::get('page2'));

if (!$custom_page->exists()) {
    Redirect::to($site->url.'/404');
}else{
    $data = $custom_page->data();
    require './views/themes/nichan/layout/header/content.php';
    require './views/themes/nichan/layout/page/content.php';
    require './views/themes/nichan/layout/footer/content.php';
}

?>