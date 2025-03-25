<?php

use Dotenv\Dotenv;

session_start();

// Fix path to autoload
require_once __DIR__ . '/../vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Database configuration
$GLOBALS['config'] = [
    'mysql' => [
        'host'     => $_ENV['DB_HOST'],
        'username' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASS'],
        'db'       => $_ENV['DB_NAME'],
        'options'  => [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    ],
    'cookie' => [
        'cookie_name'   => $_ENV['COOKIE_NAME'],
        'cookie_expiry' => $_ENV['COOKIE_EXPIRY']
    ],
    'session' => [
        'session_name' => $_ENV['SESSION_NAME'],
        'token_name'   => $_ENV['TOKEN_NAME']
    ]
];

// Autoload classes
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../classes/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Auto login via cookie
$cookieName = Config::get('cookie/cookie_name');
if (Cookie::exists($cookieName) && !Session::exists(Config::get('session/session_name'))) {
    $hash = filter_var(Cookie::get($cookieName), FILTER_SANITIZE_STRING);
    
    $db = DB::getInstance();
    $hashCheck = $db->get('nr_users_session', ['session_hash_id', '=', $hash]);

    if ($hashCheck->count()) {
        $user = new User($hashCheck->first()->session_user_id);
        $user->login();
    }
}

// Initialize site settings
$site = new Site();
$lang = new Lang();
$user = new User();

$baseUrl          = $site->get('url');
$themeDirectory   = $baseUrl . '/views/themes/' . $site->get('default_theme');

$site->url       = $baseUrl;
$site->dir_theme = $themeDirectory;
$site->dir_ajax  = $baseUrl . '/ajax.php';
$site->dir_image = $baseUrl . '/upload/images';
$site->dir_user  = $baseUrl . '/user';
$site->dir_admin = $baseUrl . '/admin-cp';

?>