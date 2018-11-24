<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $fillable = ['users_id','myfriend_id','iswhat'];

    public function user()
    {
        return $this->belongsTo(User::class,'myfriend_id');
    }
    public function profile()
    {
        return $this->belongsTo(Profile::class,'myfriend_id','user_id');
    }
}
