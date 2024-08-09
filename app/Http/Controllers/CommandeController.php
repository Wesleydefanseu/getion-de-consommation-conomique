<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Economie;
use App\Models\Commande;
use App\Models\User;
use App\Models\Commande_Product;

class CommandeController extends Controller
{


    public function validerAchat(Request $request)
    {

        $total = 0;

        $quantite = $request->quantite;
        $epargne = $request->epargne;
        $prixtotal = $request->prixtotal;

        if (!Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            // Si l'authentification échoue
            toastr()->error('Nom ou Mot de passe incorrect');
            return view('ValidationCommande', compact('quantite', 'epargne', 'prixtotal'));
        }

        $Totalprix = $request->prixtotal;

        if ($Totalprix > Auth::user()->solde) {

            toastr()->info('solde insufissant Veuillez recharger votre Wallet');

            return view('ValidationCommande', compact('quantite', 'epargne', 'prixtotal'));
        }
        if (Auth::id()) {
            $user = Auth::user();

            $userid = $user->id;

            $cart = Cart::where('user_id', $userid)->get();
        }

        foreach ($cart as $row) {

            $produit = Product::findOrFail($row->product_id);
            if (isset($produit) == false) {
                //
                toastr()->info('desole  le produit nest plus disponible');
                return redirect()->back();
            }

            if ($row->quantite > $produit->quantite) {
                //
                toastr()->info('Quantite disponible insufissante pour le produit'. $produit->nom.' ; veuillez dimunuer votre quantite');
                return redirect()->back();
            }
            $total = $total + $produit->prix * $row->quantite;
        }

        if ($total != $Totalprix) {
            //
            toastr()->info('le prix total a subit des modification (Veuillez le reverifier)');
            return redirect()->back();
        }

        $client = User::findOrFail(Auth::user()->id);
        $client->solde = $client->solde - $Totalprix;
        $client->save();

        foreach ($cart as $row) {
            $produit = Product::findOrFail($row->product_id);
            $seller = User::findOrFail($produit->seller_id);
            $seller->solde = $seller->solde + $row->quantite * $produit->prix - $row->quantite * $produit->prix * $produit->taux / 100;
            $seller->save();

            $produit->quantite =  $produit->quantite - $row->quantite;
            $produit->save();
        }


        $cmd2 = $this->validation();

        toastr()->info('commande effectuer');

        return view("detailCommande", compact('cmd2'));
    }

    public function voirCommande($id)
    {
        $cmd2=Commande::findOrFail($id);
        if(Auth::user()->usertype=='superadmin')
        {
   
            return view("superadmin.facture", compact('cmd2'));
        }
          
        return view("detailCommande", compact('cmd2'));
    }

    public function  validation()
    {
        $cmd = new Commande();
        $cmd->user_id = Auth::user()->id;
        $cmd->save();
        //selection panier
        $cart = Cart::where('user_id', Auth::user()->id)->get();

        foreach ($cart as $row) {

            $produit = Product::findOrFail($row->product_id);
            $cp = new Commande_Product();
            $cp->commande_id =  $cmd->id;
            $cp->product_id = $produit->id;
            $cp->quantite = $row->quantite;
            $cp->prixunit = $produit->prix;
            $cp->save();
            //sauvegarde des economies
            $econo = new Economie();
            $econo->user_id = Auth::user()->id;
            $econo->commande_id = $cmd->id;
            $econo->product_id = $produit->id;
            $econo->quantite = $row->quantite;
            $econo->taux = $produit->taux;
            $econo->montant = $produit->taux * $produit->prix * $row->quantite / 100;
            $econo->save();
            $row->delete();
        }
        return $cmd;
        //commande effectuer

    }
}
