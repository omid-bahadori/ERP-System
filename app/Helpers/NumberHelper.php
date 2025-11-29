<?php

namespace App\Helpers;

class NumberHelper
{
    public static function toPersian($number)
    {
        $en = ['0','1','2','3','4','5','6','7','8','9'];
        $fa = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
        return str_replace($en, $fa, $number);
    }
}
