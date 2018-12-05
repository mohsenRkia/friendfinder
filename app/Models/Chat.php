<?php

namespace App\Models;

use App\Chatmessage;
use App\helpers\deffForHumans;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['sender_id','receiver_id'];

    use deffForHumans;
    public function chatmesages()
    {
        return $this->hasMany(Chatmessage::class);
    }

    public function friend()
    {
        return $this->belongsTo(Friend::class);
    }
}
