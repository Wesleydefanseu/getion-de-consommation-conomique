<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Message;
use App\Models\Chat;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $chats = Chat::where('id_emeteur', Auth::id())->orwhere('id_recepteur', Auth::id())->orderBy('created_at','desc')->get();
        return view('messages.chat', compact('chats'));
    }
    public function affichagemessage($id)
    {
        $Chat = Chat::findOrFail($id);
        $userId = Auth::id();
        $user = User::find($userId);
        $messages = $Chat->messages()->where('id_recepteur', Auth::id())->get();
        foreach ($messages as $item) {
            $item->statut = 1;
            $item->save();
        }
        $chats = Chat::where('id_emeteur', Auth::id())->orwhere('id_recepteur', Auth::id())->get();
        return view('messages.chat', compact('chats', 'id'));
    }
    public function creeChatVendeur($id)
    {
        $chat = Chat::where('id_emeteur', $id)->where('id_recepteur', Auth::id())->count();
        if ($chat <= 0) {
            $convert = new Chat();
            $convert->id_emeteur = $id;
            $convert->id_recepteur = Auth::id();
            $convert->save();

            $message = new Message();
            $message->id_chat = $convert->id;
            $message->id_recepteur = Auth::id();
            $message->id_emeteur = $id;

            $boutique = User::findOrFail($id);
            $message->message = "Bienvenu a " . $boutique->name . " 😎👌 , " . Auth::user()->name . " . En quoi puis-je vous aider ? ";
            $message->save();

            $id = $convert->id;

            $userId = Auth::user()->id;
            $user = User::find($userId);
            $chats = Chat::where('id_emeteur', Auth::id())->orwhere('id_recepteur', Auth::id())->orderBy('created_at','desc')->get();
            $id = $convert->id;
            return view('messages.chat', compact('chats', 'id'));
        } else {
            //->latest()->first();
            $convert = Chat::where('id_emeteur', $id)->where('id_recepteur', Auth::id())->latest()->first();
            $id = $convert->id;

            $userId = Auth::user()->id;
            $user = User::find($userId);
            $chats = Chat::where('id_emeteur', Auth::id())->orwhere('id_recepteur', Auth::id())->orderBy('created_at','desc')->get();
            $id = $convert->id;
            return view('messages.chat', compact('chats', 'id'));
        }
    }


    public function store(Request $request)
    {

        $userId = Auth::id();
        $user = User::find($userId);
        $chats = Chat::where('id_emeteur', Auth::id())->orwhere('id_recepteur', Auth::id())->orderBy('created_at','desc')->get();
        return view('messages.chat', compact('chats'));
    }

    public function saveMessage(Request $request)
    {
        $message = new Message();
        $message->id_recepteur = $request->id_recepteur;
        $message->id_emeteur = Auth::id();
        $message->id_chat = $request->idConversation;
        $message->message = $request->message;
        $id = $request->idConversation;
        $message->save();

        $userId = Auth::user()->id;
        $user = User::find($userId);
        $chats = Chat::where('id_emeteur', Auth::id())->orwhere('id_recepteur', Auth::id())->orderBy('created_at','desc')->get();
        return view('messages.chat', compact('chats', 'id'));
    }
}
