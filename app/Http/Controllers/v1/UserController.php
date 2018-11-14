<?php

namespace App\Http\Controllers\v1;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function store(Request $request,User $user)
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
            return redirect()->back();
        }else{
            echo "not register";
        }
    }
}
