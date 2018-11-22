<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Log;
use App\Models\Post;
use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function profile($id,$name)
    {
        $user = User::find($id);
        $profile = Profile::where('users_id',$id)->first();


        if ($id == $user->id && $name === $user->name){

            $logs = Log::where('users_id',$id)->orderBy('created_at','desc')->paginate(5);
            $friend = Friend::where([['users_id',Auth::user()->id], ['myfriend_id',$id]])->first();
            $follower = count(Friend::where([['myfriend_id',$id]])->get());
            $following = count(Friend::where('users_id',$id)->get());
            $posts = Post::where('users_id',$id)
                ->with('file')
                ->orderBy('id','DESC')
                ->paginate(5);

            if ($follower){
                $hasFollower = count(Friend::where([['myfriend_id',$id],['iswhat',1]])->get());
                if ($following){
                    $hasFollowing = count(Friend::where([['users_id',$id],['iswhat',1]])->get());
                    return view('v1.site.profile.profile',compact(['user','posts','profile','logs','friend','hasFollower','hasFollowing']));
                }else{
                    $hasFollowing = 0;
                    return view('v1.site.profile.profile',compact(['user','posts','profile','logs','friend','hasFollower','hasFollowing']));
                }
            }else{
                $hasFollower = 0;
                if ($following){
                    $hasFollowing = count(Friend::where([['users_id',$id],['iswhat',1]])->get());
                    return view('v1.site.profile.profile',compact(['user','posts','profile','logs','friend','hasFollower','hasFollowing']));
                }else{
                    $hasFollowing = 0;
                return view('v1.site.profile.profile',compact(['user','posts','profile','logs','friend','hasFollower','hasFollowing']));
                }
            }

        }else{
            return view('errors.404');
        }

    }
    public function follow($id,Request $request)
    {
        $friendid = $id;
        $currentUserId = $request->currentUserId;

        $isFriend = count(Friend::where([
            ['users_id',$currentUserId],
            ['myfriend_id',$friendid]
        ])->get());

        if ($isFriend === 1){
            $friend = Friend::where([['users_id',$currentUserId], ['myfriend_id',$friendid]])->first();
            if ($friend->iswhat === 1){
                $friend->iswhat = 0;
                $friend->save();
                return $friend->iswhat;
            }elseif ($friend->iswhat === 0){
                $friend->iswhat = 1;
                $friend->save();
                Log::create([
                    'users_id' => $currentUserId,
                    'activity' => 4
                ]);
                return $friend->iswhat;
            }
        }else{
            $friend = Friend::create([
                'users_id' => $currentUserId,
                'myfriend_id' => $friendid,
                'iswhat' => 1
            ]);
            Log::create([
                'users_id' => $currentUserId,
                'activity' => 4
            ]);
            return $friend->iswhat;
        }
    }
}
