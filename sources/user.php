<?php

if (!defined("nichan")):
    Redirect::to($site->url.'/404');
endif;

$user_profile = new User(Input::get('page2'));

if (!$user_profile->exists()) {
    Redirect::to($site->url.'/404');
}else{
    $data = $user_profile->data();
    $posts = new Review();
    require './views/themes/nichan/layout/header/content.php';
    require './views/themes/nichan/layout/user/content.php';
    require './views/themes/nichan/layout/footer/content.php';
}

?>