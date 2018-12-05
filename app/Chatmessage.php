<?php

namespace App;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Model;

class Chatmessage extends Model
{
    protected $fillable = ['chat_id','text'];
    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}
