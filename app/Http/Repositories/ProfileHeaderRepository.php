<?php
/**
 * Created by PhpStorm.
 * User: l
 * Date: 24/11/2018
 * Time: 01:18 PM
 */

namespace App\Http\Repositories;


use App\Models\Friend;
use App\Models\Log;
use App\Models\Profile;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class ProfileHeaderRepository
{
    public function profiles()
    {
        $params = Route::current()->parameters();
        $id = $params['id'];
        $name = $params['name'];
        $user = User::find($id);
        $profile = Profile::where('user_id',$id)->first();
        if ($id == $user->id && $name === $user->name){
            $logs = Log::where('users_id',$id)->orderBy('created_at','desc')->paginate(5);
            $friend = Friend::where([['users_id',Auth::user()->id], ['myfriend_id',$id]])->first();
            $follower = count(Friend::where([['myfriend_id',$id]])->get());
            $following = count(Friend::where('users_id',$id)->get());


            if ($follower){
                $hasFollower = count(Friend::where([['myfriend_id',$id],['iswhat',1]])->get());
                if ($following){
                    $hasFollowing = count(Friend::where([['users_id',$id],['iswhat',1]])->get());
                    return compact(['user','profile','logs','friend','hasFollower','hasFollowing']);
                }else{
                    $hasFollowing = 0;
                    return compact(['user','profile','logs','friend','hasFollower','hasFollowing']);
                }
            }else{
                $hasFollower = 0;
                if ($following){
                    $hasFollowing = count(Friend::where([['users_id',$id],['iswhat',1]])->get());
                    return compact(['user','profile','logs','friend','hasFollower','hasFollowing']);
                }else{
                    $hasFollowing = 0;
                    return compact(['user','profile','logs','friend','hasFollower','hasFollowing']);
                }
            }

        }else{
            return view('errors.404');
        }

    }
}