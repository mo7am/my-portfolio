<?php

namespace App\Service;

class GeneratePasswordService
{
    public static function generate(): string
    {
        $alpha = substr(str_shuffle(str_repeat($x = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8 / strlen($x)))), 1, 8);
        $numbers = substr(str_shuffle(str_repeat($x = '0123456789', ceil(2 / strlen($x)))), 1, 2);
        $special = substr(str_shuffle(str_repeat($x = ',@$#!<>.*-+&', ceil(2 / strlen($x)))), 1, 2);

        return str_shuffle($alpha.$special.$numbers);
    }
}
