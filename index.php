<?php

define("nichan", true);

require_once __DIR__ . '/assets/init.php';

ob_start();

// Update last seen if user is logged in
if ($user->isLoggedIn()) {
    DB::getInstance()->update('nr_users', $user->data()->id, ['lastseen' => time()]);
}

// Sanitize page request
$page = filter_var(Input::get('page1'), FILTER_SANITIZE_STRING);

// Define valid pages
$validPages = [
    'terms', 'login', 'register', 'logout', 'page', 'search', 'contact', 
    'settings', 'categories', 'create-review', 'review', 'user', 'admin-cp'
];

// Route to requested page or default to home
$pagePath = '';

if (empty($page)) {
    $pagePath = 'sources/home.php';
} elseif (in_array($page, $validPages)) {
    $pagePath = "sources/{$page}.php";
} elseif ($page === 'admin-cp') {
    $pagePath = 'admin/autoload.php';
} else {
    $pagePath = 'sources/404.php';
}

// Include the selected page
require_once __DIR__ . '/' . $pagePath;

ob_end_flush();
