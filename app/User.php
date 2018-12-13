<?php

namespace App;

use App\Models\Comment;
use App\Models\Friend;
use App\Models\Post;
use App\Models\Profile;
use Elasticquent\ElasticquentTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;



class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    //use Searchable;
    use ElasticquentTrait;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function friends()
    {
        return $this->hasMany(Friend::class,'users_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class,'users_id');
    }
}
