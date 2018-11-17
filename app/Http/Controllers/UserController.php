<?php

namespace App\Http\Controllers;

use App\Jobs\VerifyUsersRegistered;
use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            if ($profile->save()){
                return redirect()->back();
            }else{
                dd('not Save');
            }
        }else{
            echo "not register";
        }
    }
}
