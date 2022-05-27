<?php

namespace App\Services\Cookie;


use App\Models\Lecture;
use Illuminate\Support\Facades\Cookie;

class CookieService {
    function storeTenRecent(Lecture $lecture){
        $num_to_store = 10;
        $minutes_to_store = 1440;
        $recent = Cookie::get('recently_viewed');
        $recent = json_decode($recent, true);
        if ($recent) {
            foreach ($recent as $key => $val) {
                if ($val == $lecture->id) {
                    unset($recent[$key]);
                }
            }
        }

        $recent[time()] = $lecture->id;

        if (sizeof($recent) > $num_to_store) {
            $recent = array_slice($recent, sizeof($recent) - 10, sizeof($recent), true);
        }
        $recent = array_reverse($recent);
        Cookie::queue('recently_viewed',json_encode($recent),$minutes_to_store);
    }
}
?>