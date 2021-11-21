<?php

namespace App\Helpers;

class StrHelper
{
    /**
     * @param int $length
     * @return string
     */
    public static function randomToken(int $length = 8): string
    {
        $keys = array_merge(range(0 ,9), range('a', 'z'), range('A', 'Z'));
        shuffle($keys);
        $key = "";
        for($i=0; $i < $length; $i++) {
            $key .= $keys[mt_rand(0, count($keys) - 1)];
        }
        if(!preg_match("(^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$)", $key)) {
            return self::randomToken($length);
        } else {
            return $key;
        }
    }
}
