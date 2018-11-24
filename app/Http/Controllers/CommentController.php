<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function send($postid,Request $request)
    {
        $userid = $request->userid;
        $text = $request->text;

        Comment::create([
            'user_id' => $userid,
            'text' => $text,
            'post_id' => $postid
        ]);

        $comments = Comment::where([['user_id',$userid],['post_id',$postid]])->orderBy('id','DESC')->with('user')->first();

        return $comments;
    }
}
