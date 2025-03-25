<?php

if (!defined("nichan")):
    Redirect::to($site->url.'/404');
endif;

if (!$user->isLoggedIn()):
    Redirect::to($site->url.'/login');
endif;

if ($user->data()->admin == 0):
    Redirect::to($site->url.'/404');
endif;

$admin = new Admin();
$token_id = Token::generate();

include('pages/header/content.php');

if (empty(Input::get('page2'))):

    include('pages/dashboard/content.php');

else:

    switch(Input::get('page2')):
        case 'add-language':
            include('pages/add-language/content.php');
            break;
        case 'changelogs':
            include('pages/changelogs/content.php');
            break;
        case 'edit-terms-pages':
            include('pages/edit-terms-pages/content.php');
            break;
        case 'email-settings':
            include('pages/email-settings/content.php');
            break;
        case 'general-settings':
            include('pages/general-settings/content.php');
            break;
        case 'generate-sitemap':
            include('pages/generate-sitemap/content.php');
            break;
        case 'manage-ads':
            include('pages/manage-ads/content.php');
            break;
        case 'manage-categories':
            include('pages/manage-categories/content.php');
            break;
        case 'manage-companies':
            include('pages/manage-companies/content.php');
            break;
        case 'manage-custom-pages':
            include('pages/manage-custom-pages/content.php');
            break;
        case 'new-custom-page':
            include('pages/manage-custom-pages/new-custom-page.php');
            break;
        case 'edit-custom-page':
            include('pages/manage-custom-pages/edit-custom-page.php');
            break;
        case 'manage-languages':
            include('pages/manage-languages/content.php');
            break;
        case 'manage-main-categories':
            include('pages/manage-main-categories/content.php');
            break;
        case 'manage-reports':
            include('pages/manage-reports/content.php');
            break;
        case 'manage-reviews':
            include('pages/manage-reviews/content.php');
            break;
        case 'manage-site-design':
            include('pages/manage-site-design/content.php');
            break;
        case 'manage-themes':
            include('pages/manage-themes/content.php');
            break;
        case 'manage-updates':
            include('pages/manage-updates/content.php');
            break;
        case 'manage-users':
            include('pages/manage-users/content.php');
            break;
        case 'online-users':
            include('pages/online-users/content.php');
            break;
        case 'site-features':
            include('pages/site-features/content.php');
            break;
        case 'site-settings':
            include('pages/site-settings/content.php');
            break;
    endswitch;

endif;

include('pages/footer/content.php');

?>