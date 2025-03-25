<?php

class Input {
    /**
     * Check if a request method has input data.
     * 
     * @param string $type 'post' or 'get'
     * @return bool
     */
    public static function exists(string $type = 'post'): bool {
        return match (strtolower($type)) {
            'post' => !empty($_POST),
            'get' => !empty($_GET),
            default => false,
        };
    }

    /**
     * Retrieve an input value securely.
     * 
     * @param string $item The input key
     * @param bool $secure Whether to sanitize the input
     * @return mixed|string
     */
    public static function get(string $item, bool $secure = true): mixed {
        $value = $_POST[$item] ?? $_GET[$item] ?? '';
        return $secure ? Secure::input($value) : $value;
    }
}

?>
