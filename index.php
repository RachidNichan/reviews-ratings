<?php

define("nichan", 1);

require_once('assets/init.php');

ob_start();

// Update last seen if user is logged in
if ($user->isLoggedIn()) {
    DB::getInstance()->update('nr_users', $user->data()->id, ['lastseen' => time()]);
}

// Page mappings
$pages = [
    'home' => 'sources/home.php',
    'terms' => 'sources/terms.php',
    'login' => 'sources/login.php',
    'register' => 'sources/register.php',
    'logout' => 'sources/logout.php',
    'page' => 'sources/page.php',
    'search' => 'sources/search.php',
    'contact' => 'sources/contact.php',
    'settings' => 'sources/settings.php',
    'categories' => 'sources/categories.php',
    '404' => 'sources/404.php',
    'create-review' => 'sources/create-review.php',
    'review' => 'sources/review.php',
    'user' => 'sources/user.php',
    'admin-cp' => 'admin/autoload.php',
];

// Sanitize page input
$page = filter_var(Input::get('page1'), FILTER_SANITIZE_STRING);

// Default to 'home' if no page is specified
$page = empty($page) ? 'home' : $page;

// Check if page exists in the mapping, else default to '404'
$pagePath = isset($pages[$page]) ? $pages[$page] : $pages['404'];

// Include the appropriate page
require_once($pagePath);

ob_end_flush();

?>
