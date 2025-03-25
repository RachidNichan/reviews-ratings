<?php

if (!defined("nichan")):
    Redirect::to($site->url.'/404');
endif;

$categories = new Review();

if (empty(Input::get('page2'))) {
    require './views/themes/nichan/layout/header/content.php';
    require './views/themes/nichan/layout/categories/content.php';
    require './views/themes/nichan/layout/footer/content.php';
}else if ($categories->findCategory(Input::get('page2'))) {

    $data = $categories->data();

    $pagination = new Pagination([
        'totalCount' => $categories->countReviewInCategories($data->id),
    ]);

    require './views/themes/nichan/layout/header/content.php';
    require './views/themes/nichan/layout/categories/list.php';
    require './views/themes/nichan/layout/footer/content.php';
} else {
    Redirect::to($site->url.'/404');
}

?>