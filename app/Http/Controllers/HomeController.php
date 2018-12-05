<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        $countUsers = count(User::all());
        $countPosts = count(Post::all());
        $ago = Carbon::now()->subMinute();
        $usersOnline = User::where('lastactive','>=',$ago)->with('profile')->inRandomOrder()->take(6)->get();
        $onlineUsersNumber = count(User::where('lastactive','>=',$ago)->get());
        $logsFirst = Log::orderBy('created_at','DESC')->with(['user' => function($q){$q->with('profile');}])->take(5)->get();
        $logsSecond = Log::orderBy('created_at','DESC')->with(['user' => function($q){$q->with('profile');}])->skip(5)->take(5)->get();

        //dd($logsSecond->toArray());
        return view('v1.site.index',compact(['countUsers','countPosts','onlineUsersNumber','usersOnline','logsFirst','logsSecond']));
    }
}
