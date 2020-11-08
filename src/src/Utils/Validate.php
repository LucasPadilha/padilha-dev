<?php
declare(strict_types=1);

namespace App\Utils;

class Validate
{
    /**
     * @var array $haystack
     * @var array|string $needle
     * @var bool $keys
     * @return bool
     */
    public static function in_array(array $haystack, $needle, bool $keys = false): bool
    {   
        if ($keys) {
            $needle = array_keys($needle);
        }

        if (is_array($needle)) {
            foreach ($needle as $n) {
                if (!self::isNeedleInArray($n, $haystack)) {
                    return false;
                }
            }
        } else {
            if (!self::isNeedleInArray($needle, $haystack)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @var string $email
     * @return bool
     */
    public static function is_email(string $email): bool
    {   
        if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
            return true;
        }
        
        return false;
    }

    /**
     * @var string $needle
     * @var array $array
     * @return bool
     */
    private static function isNeedleInArray(string $needle, array $array): bool
    {   
        $found = false;

        foreach ($array as $a) {
            if ($needle == $a) {
                $found = true;
            }
        }

        return $found;
    }
}