<?php

class Secure {
    
    /**
     * Sanitizes the input string by trimming and sanitizing.
     * 
     * @param string $string The input string to sanitize.
     * @return string The sanitized string.
     */
    public static function input($string) {
        // Trim the string and sanitize it for malicious content
        $string = trim($string);
        
        // Use FILTER_SANITIZE_FULL_SPECIAL_CHARS for better sanitation of input
        $string = filter_var($string, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        // Return the sanitized string
        return $string;
    }

    /**
     * Escapes special characters for safe output in HTML.
     * 
     * @param string $string The input string to escape.
     * @return string The escaped string.
     */
    public static function escape($string) {
        // Use htmlspecialchars with the correct flags and UTF-8 encoding
        return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }
}
?>