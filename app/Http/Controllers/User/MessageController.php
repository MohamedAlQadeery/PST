<?php

namespace App\Http\Controllers\User;

use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $messages = Message::where('sender_id', auth()->user()->id);

        if ($request->has('title')) {
            $messages = $messages->where('title', 'like', '%'.$request->input('title').'%');
        }

        $messages = $messages->orderBy('read', 'asc')->get();

        return view('back.contact_us.index')->with([
            'messages' => $messages,
            'page_name' => 'messages',
        ]);
    }
}
