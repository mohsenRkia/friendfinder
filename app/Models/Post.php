<?php

namespace App\Models;

use App\helpers\deffForHumans;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['users_id','text'];
    use deffForHumans;
    public function file()
    {
        return $this->hasOne(File::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function like()
    {
        return $this->hasOne(Like::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
