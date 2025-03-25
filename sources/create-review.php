<?php

if (!defined("nichan")):
    Redirect::to($site->url.'/404');
endif;

if (!$user->isLoggedIn()):
    Redirect::to($site->url.'/login');
endif;

if (empty(Input::get('page2'))) {
require './views/themes/nichan/layout/header/content.php';
require './views/themes/nichan/layout/review/create.php';
require './views/themes/nichan/layout/footer/content.php';
}

$review = new Review(Input::get('page2'));

if (!empty(Input::get('page2')) && Input::get('page2') === $review->data()->review_username) {
    if ($review->data()->review_step_info == 0) {
        require './views/themes/nichan/layout/header/content.php';
        require './views/themes/nichan/layout/review/step-2.php';
        require './views/themes/nichan/layout/footer/content.php';
    } else {
        Redirect::to($site->url.'/404');
    }
}


?>