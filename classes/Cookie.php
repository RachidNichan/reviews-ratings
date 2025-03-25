<?php

class Cookie {
    public static function exists(string $name): bool {
        return isset($_COOKIE[$name]);
    }

    public static function get(string $name): ?string {
        return self::exists($name) ? $_COOKIE[$name] : null;
    }

    public static function put(string $name, string $value, int $expiry): bool {
        return setcookie($name, $value, time() + $expiry, '/', '', false, true);
    }

    public static function delete(string $name): bool {
        if (self::exists($name)) {
            return self::put($name, '', -1);
        }
        return false;
    }
}

?>
