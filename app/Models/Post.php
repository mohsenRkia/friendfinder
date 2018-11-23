<?php

namespace App\Models;

use App\helpers\deffForHumans;
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

}
