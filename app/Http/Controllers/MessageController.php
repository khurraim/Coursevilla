<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function SaveMessage()
    {
        $message = new Message();

        $message->name = request('name');
        $message->email = request('email');
        $message->phone = request('phone');
        $message->subject = request('subject');
        $message->body = request('body');

        $message->save();

        return redirect('/');
    }
}
