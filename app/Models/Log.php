<?php

namespace App\Models;

use App\helpers\deffForHumans;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['users_id','activity'];

    use deffForHumans;
}
