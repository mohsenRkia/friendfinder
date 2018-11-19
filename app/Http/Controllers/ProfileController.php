<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function profile($id,$name)
    {
        $user = User::find($id);
        $profiles = Profile::where('users_id',$id)->get();


        if ($id == $user->id && $name === $user->name){


            return view('v1.site.profile.profile',compact(['user','profiles']));
        }else{
            return view('errors.404');
        }

    }
}
