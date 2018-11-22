<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['path','post_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
