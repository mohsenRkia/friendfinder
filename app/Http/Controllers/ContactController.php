<?php

namespace App\Http\Controllers;

use App\Jobs\ContactMail;
use App\Mail\MailContact;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

    public function messages()
    {
        $messages = Message::paginate(10);

        return view('v1.admin.messages.index',compact(['messages']));
    }

    public function store($id)
    {
        $pm = Message::find($id);

        return view('v1.admin.messages.store',compact(['pm']));
    }

    public function reply(Request $request)
    {
        $contactpm = $request->contactpm;
        $email = $request->email;
        $name = $request->name;


        //dd($email);
        //$sendMail = Mail::to($to)->send(new MailContact($contactpm));
        $sendMail = ContactMail::dispatch($name,$email,$contactpm);

        if ($sendMail){
            return redirect()->route('message.index');
        }else{
            return redirect()->back();
        }



    }

    public function destroy($id)
    {
        $pm = Message::find($id);

        if ($pm->delete()){
            return redirect()->back();
        }
        return redirect()->route('admin.index');
    }
}
