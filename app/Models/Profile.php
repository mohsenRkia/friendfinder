<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['avatar', 'nickname', 'bio','birthdate', 'gender', 'phone','location', 'job'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
