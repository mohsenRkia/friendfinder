<?php
/**
 * Created by PhpStorm.
 * User: l
 * Date: 20/11/2018
 * Time: 03:26 PM
 */

namespace App\helpers;


use Carbon\Carbon;

trait deffForHumans
{
    public function getCreatedAtAttribute($timestamps)
    {
            $time = Carbon::parse($timestamps)->diffForHumans();
            return $time;
    }
}