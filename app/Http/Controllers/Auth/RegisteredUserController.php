<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Stevebauman\Location\Facades\Location;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //: RedirectResponse
        // $user=$request->ip();
        //  $location=Location::get($user);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'localisation' => $request->localisation,
            'password' => Hash::make($request->password),
            'creator_id' => $request->creator_id,
        ]);
        event(new Registered($user));

        Auth::login($user);
        $conver = new Chat();
        $conver->id_recepteur = Auth::id();
        $super = User::where('usertype', 'superadmin')->latest()->first();
     
        $conver->id_recepteur = Auth::id();
        $conver->id_emeteur = $super->id;
        $conver->save();
        ///
        $message=new Message();
        $message->id_recepteur = Auth::id();
        $message->id_emeteur = $super->id;
        $message->id_chat =   $conver->id;
        $message->message="Bonjour ".Auth::user()->name." 🙌😘, soyez le bienvenue a Lumia Market. En quoi puis-je vous etre utile ?";
        $message->save();
        // return redirect(route('welcome'));
        return view('auth.login');
    }
}
