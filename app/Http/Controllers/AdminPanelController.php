<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Friend;
use App\Models\Post;
use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPanelController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
        $countPosts = count(Post::where('users_id',$user)->get());
        $followers = count(Friend::where('myfriend_id',$user)->get());
        $following = count(Friend::where('users_id',$user)->get());
        $comments = count(Comment::where('user_id',$user)->get());

        return view('v1.admin.index',compact(['countPosts','comments','following','followers']));
    }

    public function edit($id)
    {
        $firstInfo = User::find($id);
        $secondInfo = Profile::where('user_id' , $id)->get();

        return view('v1.admin.edit',compact(['firstInfo','secondInfo']));
    }
}
