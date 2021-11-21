<?php

namespace App\Helpers;

use Carbon\Carbon;

class UrlHelper
{
    /**
     * @param \App\Link $link
     * @return bool
     */
    public static function expire(\App\Link $link): bool
    {
        return $link->life_time * 3600 <= Carbon::parse($link->created_at)->diffInSeconds();
    }

    /**
     * @param \App\Link $link
     * @return bool
     */
    public static function maxVisitDetect(\App\Link $link): bool
    {
        return $link->max_visit > 0 && $link->max_visit <= $link->total_visit;
    }
}
