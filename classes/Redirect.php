<?php

class Redirect {
    public static function to(string $location = ''): void {
        if (!empty($location)) {
            header("Location: " . filter_var($location, FILTER_SANITIZE_URL), true, 302);
            exit;
        }
    }
}

?>
