<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Log;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function send($id,Request $request)
    {
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
