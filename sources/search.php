<?php

if (!defined("nichan")):
    Redirect::to($site->url.'/404');
endif;

if (empty(Input::get('page2'))) {
    Redirect::to($site->url.'/404');
} else {
    $search = new Search();
    $review = new Review();

    $pagination = new Pagination([
        'totalCount' => $search->countSearch(Input::get('page2')),
    ]);

    $all_search = $search->getSearch(Input::get('page2'), $pagination->offset, $pagination->limit);
    require './views/themes/nichan/layout/header/content.php';
    require './views/themes/nichan/layout/search/content.php';
    require './views/themes/nichan/layout/footer/content.php';

}

?>