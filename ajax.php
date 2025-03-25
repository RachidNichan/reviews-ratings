<?php

// Allow only POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    exit();
}

require_once __DIR__ . '/assets/init.php';

// Sanitize input
$action = filter_var(Input::get('a'), FILTER_SANITIZE_STRING);
$param  = filter_var(Input::get('b'), FILTER_SANITIZE_STRING);

// Validate required parameters
if (empty($action) || empty($param)) {
    http_response_code(400); // Bad Request
    exit();
}

// Define valid controllers
$validControllers = [
    'admin', 'search', 'helpful', 'post', 'user', 'review'
];

// Process request
if (in_array($action, $validControllers)) {
    require_once __DIR__ . "/controllers/{$action}.php";
} else {
    http_response_code(404); // Not Found
    exit();
}
