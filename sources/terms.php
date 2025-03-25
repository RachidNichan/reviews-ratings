<?php

if (!defined("nichan")):
    Redirect::to($site->url.'/404');
endif;

$term = new Terms(Input::get('page2'));

if (!$term->exists()) {
    Redirect::to($site->url.'/404');
}else{
    $data = $term->data();

    require './views/themes/nichan/layout/header/content.php';

    switch ($data->type) {
        case 'terms-of-use':
            require './views/themes/nichan/layout/terms/terms-of-use.php';
            break;
        case 'privacy-policy':
            require './views/themes/nichan/layout/terms/privacy-policy.php';
            break;
        case 'about-us':
            require './views/themes/nichan/layout/terms/about-us.php';
            break;
    }

    require './views/themes/nichan/layout/footer/content.php';

}

?>