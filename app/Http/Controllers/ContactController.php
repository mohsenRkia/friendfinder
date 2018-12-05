<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        return view('v1.site.contact.index');

    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|between:8,54|regex:/^[a-zA-Z0-9]+$/',
            'email' => 'required|email',
            'phone' => 'required|max:11|regex:/^[0][9][0-9]{9}/',
            'text' => 'required|max:500'
        ]);
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $text = $request->text;

        $message = Message::create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'text' => $text
        ]);

        return $message;
    }
}
