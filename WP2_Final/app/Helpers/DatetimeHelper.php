<?php

namespace App\Helpers;

class DatetimeHelper
{
    public static function now(string $format = "Y-m-d H:i:s", $time =  "now")
    {
        return  date_format(date_create($time), $format);
    }
}
