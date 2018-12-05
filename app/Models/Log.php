<?php

namespace App\Models;

use App\helpers\deffForHumans;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['users_id','activity'];

    use deffForHumans;

    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }
}
