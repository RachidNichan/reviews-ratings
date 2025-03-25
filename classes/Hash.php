<?php

class Hash {

    private static function make(int $min, int $max): int {
        if ($min >= $max) return $min;
        
        $range = $max - $min + 1;
        $bytes = ceil(log($range, 2) / 8) + 1;
        $filter = (1 << (ceil(log($range, 2)) + 1)) - 1;
        
        do {
            $rnd = random_int(0, $filter);
        } while ($rnd >= $range);
        
        return $min + $rnd;
    }

    public static function unique(int $length = 16): string {
        $codeAlphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $max = strlen($codeAlphabet) - 1;
        $token = '';

        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[self::make(0, $max)];
        }

        return $token;
    }

    public static function password(string $password, int $cost = 12): string {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => $cost]);
    }
}

?>