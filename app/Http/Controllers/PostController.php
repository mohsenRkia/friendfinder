<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\File;
use App\Models\Log;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function send($id,Request $request)
    {
        $request->validate([
            'image' => 'between:1,1000|mimes:jpeg,jpg,png|dimensions:min_width=400,min_height=150|dimensions:max_width=1280,max_height=1280',
            'text' => 'max:500'
        ]);
        $text = $request->text;
        $posts = Post::create([
            'users_id' => $id,
            'text' => $text
        ]);

        if ($posts){
            $file = $request->file('image');
            $imageName = time() . "_" . $file->getClientOriginalName();
            $path = public_path() . "/uploads/posts";
            $file->move($path,$imageName);

            $files = File::create([
                'path' => $imageName,
                'post_id' => $posts->id
            ]);

            if ($files){
                Log::create([
                    'users_id' => $id,
                    'activity' => 3
                ]);

                $lastPosts = Post::where('users_id',$id)->orderBy('id','DESC')
                    ->with('file')
                    ->first();

                return $lastPosts;
            }
        }

        return $text;
    }

}
