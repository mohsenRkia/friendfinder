<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $countUsers = count(User::all());
        return view('v1.site.index',compact(['countUsers']));
    }
}
