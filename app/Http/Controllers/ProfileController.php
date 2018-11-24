<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Log;
use App\Models\Post;
use App\Models\Profile;
use App\User;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function timeline($id,$name)
    {
        $user = User::find($id);
        $profile = Profile::where('user_id',$id)->first();
        $friend = Friend::where([['users_id',Auth::user()->id], ['myfriend_id',$id]])->first();

        $posts = Post::where('users_id',$id)
                ->with('file')
                ->with('like')
                ->with(['comments' => function($q){
                    $q->with(['user' => function($u){
                        $u->with('profile');
                    }]);
                }])
                ->orderBy('id','DESC')
                ->paginate(5);


        return view('v1.site.profile.pages.timeline',compact(['user','profile','posts','friend']));

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

    public function about($id,$name)
    {
        $profile = Profile::where('user_id',$id)->first();
        return view('v1.site.profile.pages.about',compact(['profile']));
    }

    public function friends($id,$name)
    {
        $user = User::find($id)->where('name',$name)
            ->with(['friends' => function($q){
                $q->where('iswhat',1);
                $q->with('profile')
                ->with('user');
            }])
            ->first();


        //dd($user->toArray());
        return view('v1.site.profile.pages.friends',compact('user'));
    }

    public function album($id,$name)
    {
        $user = User::find($id)->where('name',$name)
            ->with(['posts' => function($q){
                $q->with('file');
            }])
            ->first();

        //dd($user->toArray());
        return view('v1.site.profile.pages.album',compact(['user']));
    }
}
