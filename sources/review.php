<?php

if (!defined("nichan")):
    Redirect::to($site->url.'/404');
endif;

$review = new Review(Input::get('page2'));

if (!$review->exists()) {
    Redirect::to($site->url.'/404');
}else{
    $data = $review->data();
    require './views/themes/nichan/layout/header/content.php';
    require './views/themes/nichan/layout/review/content.php';
    require './views/themes/nichan/layout/footer/content.php';
}

?>