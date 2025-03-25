<?php

class Token {
    /**
     * Generate a new CSRF token and store it in the session.
     *
     * @return string The generated token.
     * @throws Exception If token generation fails.
     */
    public static function generate() {
        // Generate a unique token
        $token = Hash::unique(50);

        // Store it in the session
        if (!Session::put(Config::get('session/token_name'), $token)) {
        }

        return $token;
    }

    /**
     * Check if the provided token matches the stored token in session.
     *
     * @param string $token The token to check.
     * @return bool True if the token matches, false otherwise.
     */
    public static function check($token) {
        // Get the token name from configuration
        $tokenName = Config::get('session/token_name');

        // Ensure the token exists in session and matches the provided token
        if (Session::exists($tokenName) && $token === Session::get($tokenName)) {
            return true;
        }

        return false;
    }

    /**
     * Check if the token has expired (if expiration logic is implemented).
     *
     * @param int $expiryTime The expiry time in seconds.
     * @return bool True if the token has expired, false otherwise.
     */
    public static function isExpired($expiryTime) {
        $tokenCreationTime = Session::get(Config::get('session/token_creation_time'));

        if ($tokenCreationTime && (time() - $tokenCreationTime) > $expiryTime) {
            return true;
        }

        return false;
    }

    /**
     * Store the token creation time to handle token expiration.
     *
     * @param string $token The generated token.
     * @throws Exception If session storage fails.
     */
    public static function storeCreationTime($token) {
        $time = time();
        if (!Session::put(Config::get('session/token_creation_time'), $time)) {
            throw new Exception("Failed to store token creation time in session.");
        }
    }
}
?>
