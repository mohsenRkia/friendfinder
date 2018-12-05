<?php

namespace App\Http\Controllers;

use App\Chatmessage;
use App\Models\Chat;
use App\Models\Friend;
use App\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index($id,$name)
    {
        $user = User::find($id)->where('name',$name)->with('profile')->first();
        $hasFollower = count(Friend::where('users_id',$id)->get());

        $allFriends = Friend::where([['users_id',$id],['iswhat',1]])->with(['user' => function($q){
            $q->with('profile');
        }])->get();

        $allChats = Chat::where('sender_id',$id)->orWhere('receiver_id',$id)->with('chatmesages')->orderBy('created_at')->get();

        //dd([$allFriends->toArray(),$allChats->toArray()]);
        return view('v1.site.chats',compact(['user','hasFollower','allFriends','allChats']));
    }

    public function send($id,Request $request)
    {
        $receiverId = $request->receiverId;
        $senderId = $id;

        $chat = Chat::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId
        ]);

        if ($chat){
            $chatId = $chat->id;
            $text = $request->text;

            Chatmessage::create([
                'chat_id' => $chatId,
                'text' => $text
            ]);

        }
    }


}
