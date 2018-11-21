<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Post;
use Illuminate\Http\Request;

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
            $path = public_path() . "/posts";
            $file->move($path,$imageName);

            $files = File::create([
                'path' => $imageName,
                'posts_id' => $posts->id
            ]);

            if ($files){
                return $files;
            }
        }

        return $text;
    }
}
