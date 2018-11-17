<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;

class UserPanelController extends Controller
{
    public function index()
    {
        return view('v1.user.index');
    }

    public function edit($id,Profile $profile)
    {
        $firstInfo = User::find($id);
        $secondInfo = $profile->where('users_id' , $id)->get();

        //dd($secondInfo->toArray());
        return view('v1.user.edit',compact(['firstInfo' , 'secondInfo']));

    }

    public function update($id,Request $request)
    {
        $user = User::find($id);
        $request->validate([
            'name' => 'required|between:8,54|unique:users,name|regex:/^[a-zA-Z0-9]+$/',
            'email' => 'required|email|unique:users,email',
            'isadmin' => 'numeric'
        ]);


        $user->name = $request->name;
        $user->email = $request->email;

        if ($user->save()){
            return redirect()->back();
        }

        return redirect()->back();
    }
}
