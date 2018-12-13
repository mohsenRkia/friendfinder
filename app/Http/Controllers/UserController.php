<?php

namespace App\Http\Controllers;

use App\Jobs\VerifyUsersRegistered;
use App\Models\Friend;
use App\Models\Log;
use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function store(Request $request,User $user,Profile $profile)
    {
        $request->validate([
            'name' => 'required|between:8,54|unique:users,name|regex:/^[a-zA-Z0-9]+$/',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|between:8,54'
        ]);


        $name = $request->name;
        $email = $request->email;
        $password = Hash::make($request->password);

        $user->name = $name;
        $user->email = $email;
        $user->password = $password;

        if ($user->save()){
            dispatch(new VerifyUsersRegistered($user));

            $profile->users_id = $user->id;
            $profile->gender = 0;
            $profile->avatar = "avatar.png";
            $profile->bgprofile = "bgprofiles.jpg";

            if ($profile->save()){
                Log::create([
                    'users_id' => $user->id,
                    'activity' => 1
                ]);

                return redirect()->back();
            }else{
                dd('not Save');
            }
        }else{
            dd("not register");
        }
    }

    public function search(Request $request)
    {
        $request->validate([
            'key' => 'required'
        ]);
        $key = $request->key;
        $resault = User::where('name','LIKE','%'.$key.'%')->with('profile')->paginate(20);

        if (Auth::check()){
            $friend_id = [];
            $friends = Friend::where('users_id',Auth::user()->id)->get();

            foreach ($friends as $friend){
                $friend_id[] = $friend->myfriend_id;
            }

//dd($friend_id);
            return view('v1.site.search',compact(['resault','key','friends','friend_id']));
        }else{
            return view('v1.site.search',compact(['resault','key']));
        }


    }
}
