<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function add($postid,Request $request)
    {
        $userid = $request->userid;

        $likes = Like::where([['user_id',$userid],['post_id',$postid]])->get();
        if (count($likes) == 1){
            $likess = Like::where([['user_id',$userid],['post_id',$postid]])->first();
            $likess->vote = $request->vote;
            $likess->save();

        }elseif(count($likes) == 0){
            Like::create([
                'user_id' => $userid,
                'post_id' => $postid,
                'vote' => $request->vote
            ]);
        }

    }
}
