<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['vote','user_id','post_id'];
    public function post()
    {
        return $this->hasOne(Post::class);
    }
}
