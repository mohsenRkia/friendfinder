<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Friend;
use App\Models\Log;
use App\Models\Post;
use App\Models\Profile;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;


class UserPanelController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
        $countPosts = count(Post::where('users_id',$user)->get());
        $followers = count(Friend::where('myfriend_id',$user)->get());
        $following = count(Friend::where('users_id',$user)->get());
        $comments = count(Comment::where('user_id',$user)->get());

        return view('v1.user.index',compact(['countPosts','followers','following','comments']));
    }

    public function edit($id,Profile $profile)
    {
        $firstInfo = User::find($id);
        $secondInfo = $profile->where('user_id' , $id)->get();

        return view('v1.user.edit',compact(['firstInfo' , 'secondInfo']));

    }

    public function update($id,Request $request)
    {

        $user = User::find($id);
        $request->validate([
            'name' => 'required|between:8,54|regex:/^[a-zA-Z0-9]+$/|unique:users,name,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($user->save()){

        $request->validate([
            'avatar' => 'between:1,500|mimes:jpeg,jpg,png|dimensions:min_width=150,min_height=150|dimensions:max_width=1280,max_height=1280',
            'bgprofile' => 'between:1,1000|mimes:jpeg,jpg,png|dimensions:min_width=600,min_height=200|dimensions:max_width=1280,max_height=400',
            'nickname' => 'nullable|alpha_dash|max:80',
            'bio' => 'nullable|max:500',
            'gender' => 'numeric|regex:/[012]{1}/|max:1',
            'phone' => 'nullable|max:11|regex:/^[0][9][0-9]{9}/',
            'location' => 'nullable|min:2|max:100',
            'job' => 'nullable|min:2|max:100'


        ]);

        $profile = Profile::where('user_id',$user->id)->first();

        if ($request->file('avatar')){
            $avatar = $request->file('avatar');
            $picName = time() . "_" . $avatar->getClientOriginalName();
            $path = public_path() . "/uploads/avatars/uplode";
            $avatar->move($path,$picName);
            $profile->avatar = $picName;
        }
        if ($request->file('bgprofile')){
            $bgprofile = $request->file('bgprofile');
            $bgname = time() . "_" . $bgprofile->getClientOriginalName();
            $dir = public_path() . "/uploads/bgprofiles/uplode";
            $bgprofile->move($dir,$bgname);
            $profile->bgprofile = $bgname;
        }
        $profile->nickname = $request->nickname;
        $profile->bio = $request->bio;
        $profile->gender = $request->gender;
        $profile->phone = $request->phone;
        $profile->location = $request->location;
        $profile->job = $request->job;

        if ($profile->save()){
            Log::create([
                'users_id' => $user->id,
                'activity' => 2
            ]);

            return redirect()->back();
        }
    }

    return redirect()->back();
    }

    public function list()
    {
        $users = User::with('profile')->orderBy('created_at','DESC')->paginate(20);

        //dd($users->toArray());
        return view('v1.admin.list',compact(['users']));
    }

}
