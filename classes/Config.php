<?php

class Config {
    public static function get(string $path = null): mixed {
        if (!$path) {
            return null;
        }

        $config = $GLOBALS['config'];
        $pathSegments = explode('/', $path);

        foreach ($pathSegments as $bit) {
            if (!isset($config[$bit])) {
                return null;
            }
            $config = $config[$bit];
        }

        return $config;
    }
}
