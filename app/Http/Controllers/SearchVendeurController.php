<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\categorieProduit;

class SearchVendeurController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = $request->input('query');

        $option = $request->page;
        $title = 'Ajouter';
        if ($option == 1) {
            $vendeurs = User::findOrFail(Auth::id());
            $search =  $vendeurs->categorieProduits()->where('nom', 'LIKE', "%{$query}%")->orderBy('created_at', 'desc')->get();
            return view('seller.ajouterCategorieProduit', compact('search', 'title', 'query'));
        }
        if ($option == 2) {
            $datanamecatg = CategorieProduit::all();
            $vendeurs = User::findOrFail(Auth::id());
            $search =  $vendeurs->products()->where('nom', 'LIKE', "%{$query}%")->orwhere('description', 'LIKE', "%{$query}%")->orderBy('created_at', 'desc')->get();
            return view('seller.listingProduit2', compact('search', 'query', 'datanamecatg'));
        }
        //->pluck('id');
        if ($option == 3 || $option == 4 ) {
            $search = User::
            where('name', 'LIKE', "%{$query}%")
            -> orwhere('telephone',$query)
            -> orWhere('email', 'LIKE', "%{$query}%")
            ->pluck('id')->toArray();
            if($option == 4 )
            {
                return view('seller.commande', compact('search', 'query'));
            }
            return view('seller.client', compact('search', 'query'));       
        }

        if ($option == 5) {
            $admin = User::findOrFail(Auth::id());
            $search =  $admin->childs()->where('name','LIKE',"%{$query}%")
            ->orWhere('telephone',$query)->orwhere('categorie',$query)
            ->orWhere('email',$query)->get();
            return view('admin.index', compact('search', 'query'));
        }

        if ($option == 11) {
            
            $search = User::
            where('name', 'LIKE', "%{$query}%")
            -> orwhere('telephone',$query)
            -> orWhere('email', 'LIKE', "%{$query}%")
            ->pluck('id')->toArray();
            $id = $request->input('id');

            $userId = Auth::id();
            $user = User::find($userId);
            $chats = Chat::where('id_emeteur', Auth::id())->orwhere('id_recepteur', Auth::id())->orderBy('created_at','desc')->get();
           


            if($id==null)
            {
                toastr()->success('Produit ajouter avec succes');
                return view('messages.chat', compact('search', 'query','chats'));  
            }
            return view('messages.chat', compact('search', 'query','id','chats'));  
        }
    }
}
