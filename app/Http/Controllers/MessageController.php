<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use App\Models\Message;
use App\Events\MessageSent;
class MessageController extends Controller
{
     public function index($id)
    {
        $userId = Auth::id();
        $messages = Message::where(function($query) use ($userId, $id) {
            $query->where('id_emeteur', $userId)
                  ->where('id_recepteur', $id);
        })->orWhere(function($query) use ($userId, $id) {
            $query->where('id_emeteur', $id)
                  ->where('id_recepteur', $userId);
        })->orderBy('created_at')->get();

        return view('messages.index', compact('messages', 'id'));
    }

    public function store(Request $request)
    {
        $message = new Message();
        $message->id_emeteur = Auth::id();
        $message->id_recepteur = $request->id_recepteur;
        $message->message = $request->message;
        $message->save();

        event(new MessageSent($message));

        return response()->json(['message' => 'Message sent successfully']);
    }
}
