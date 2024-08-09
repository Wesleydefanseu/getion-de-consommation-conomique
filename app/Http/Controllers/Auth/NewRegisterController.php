<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Forfait;
use App\Models\Chat;
use App\Models\Message;
use Stevebauman\Location\Facades\Location;

class NewRegisterController extends Controller
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
        $tof = '';
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'usertype' => ['nullable', 'string', 'max:255'],
        ]);


        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $file_name = time() . $file->getClientOriginalName();
            $file->move(public_path('photosUsers'), $file_name);
            $tof  = $file_name;
        } else {
            toastr()->timeOut(10000)->closeButton()->addError(' Photo invalide');
            return redirect()->back();
        }


        if (Auth::user()->usertype === 'superadmin') {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'usertype' => $request->usertype,
                'password' => Hash::make($request->password),
                'creator_id' => Auth::user()->id,
                'photo' => $tof,
            ]);
            $type = $request->usertype;
            $name = $request->name;
            $user->save();
            $count = User::where('name', $name)->where('usertype', 'seller')->count();

            if ($type == 'user') {
                $type = 'Utilisateur';
            }
            if ($type == 'admin') {
                $type = 'Manageur';
            }
            if ($type == 'seller') {
                $user->categorie = 'Or';
                $user->save();
                $type = 'Vendeur';
                $forfait = new Forfait();
                $forfait->seller_id = $user->id;
                $forfait->dette = 0;
                $forfait->save();
                if(  $count > 0)
                {

                }
            }

            toastr()->timeOut(10000)->closeButton()->addSuccess($type . ' ajouté avec success');
            $conver = new Chat();
            $conver->id_recepteur =  $user->id;
            $super = User::where('usertype', 'superadmin')->latest()->first();
            $conver->id_emeteur = $super->id;
            $conver->save();
            ///
            $message = new Message();
            $message->id_recepteur =   $user->id;
            $message->id_emeteur = $super->id;
            $message->id_chat =   $conver->id;
            $message->message = "Bonjour " . $user->name . " 🙌😘, soyez le bienvenue a Lumia Market. En quoi puis-je vous etre utile ?";
            $message->save();
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'usertype' => 'seller',
                'categorie' => $request->categorie,
                'password' => Hash::make($request->password),
                'creator_id' => $request->creator_id,
                'photo' => $tof,
            ]);


            $user->creator_id = (int) Auth::user()->id;
            $user->save();
            $forfait = new Forfait();
            $forfait->seller_id = $user->id;
            $forfait->dette = 0;
            $forfait->save();

            toastr()->timeOut(10000)->closeButton()->addSuccess(' Vendeur ajouté avec success');

            $conver = new Chat();
            $conver->id_recepteur =  $user->id;
            $super = User::where('usertype', 'superadmin')->latest()->first();
            $conver->id_recepteur = $user->id;
            $conver->id_emeteur = $super->id;
            $conver->save();
            ///
            $message = new Message();
            $message->id_recepteur =   $user->id;
            $message->id_emeteur = $super->id;
            $message->id_chat =   $conver->id;
            $message->message = "Bonjour " . $user->name . " 🙌😘, soyez le bienvenue a Lumia Market. En quoi puis-je vous etre utile ?";
            $message->save();
        }

        // event(new Registered($user));

        // Auth::login($user);

        // return redirect(route('welcome'));
        return redirect()->back();
    }
}
