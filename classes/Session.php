<?php

class Session {

    /**
     * Checks if a session variable exists.
     * 
     * @param string $name The session variable name.
     * @return bool True if the session variable exists, false otherwise.
     */
    public static function exists($name) {
        return isset($_SESSION[$name]);
    }

    /**
     * Sets a session variable.
     * 
     * @param string $name The session variable name.
     * @param mixed $value The value to assign to the session variable.
     * @return void
     */
    public static function put($name, $value) {
        $_SESSION[$name] = $value;
    }

    /**
     * Retrieves the value of a session variable.
     * 
     * @param string $name The session variable name.
     * @return mixed The value of the session variable.
     */
    public static function get($name) {
        return self::exists($name) ? $_SESSION[$name] : null;
    }

    /**
     * Deletes a session variable.
     * 
     * @param string $name The session variable name.
     * @return void
     */
    public static function delete($name) {
        if (self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    /**
     * Retrieves and deletes a session variable for temporary use (flash).
     * 
     * @param string $name The session variable name.
     * @param string $string Optional: The value to set if the session does not exist.
     * @return mixed The session value if it exists, otherwise null or the set string.
     */
    public static function flash($name, $string = '') {
        if (self::exists($name)) {
            $session = self::get($name);
            self::delete($name);
            return $session;
        } else {
            self::put($name, $string);
        }
    }

    /**
     * Starts the session if it has not been started already.
     * 
     * @return void
     */
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Destroys all session data and ends the session.
     * 
     * @return void
     */
    public static function destroy() {
        session_unset();
        session_destroy();
    }
}
?>
