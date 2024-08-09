<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Economie;
use App\Models\Product;
use App\Models\Tranfert;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


class CartController extends Controller
{
    //

    public function add_cart($id)
    {
        if (isset(Auth::user()->id) == false) {
            return view('auth.login');
        }

        $count = Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->count();
        if ($count > 0) {
            return response()->json(['success' => false, 'error' => 'Vous avez déjà ajouté ce produit dans votre panier']);
        }

        $produit = Product::find($id);
        if ($produit->quantite <= 0) {
            return response()->json(['success' => false, 'error' => 'Ce produit n\'est plus disponible']);
        }

        $product_id = $id;
        $user = Auth::user();
        $user_id = $user->id;

        $data = new Cart;
        $data->user_id = $user_id;
        $data->product_id = $product_id;
        $data->save();


        return response()->json(['success' => true, 'message' => 'Produit ajouté au panier']);
    }


    public function mycart()
    {

        if (Auth::id()) {
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id', $userid)->count();

            $cart = Cart::where('user_id', $userid)->get();
        }

        return view('cart.cart', compact('count', 'cart'));
    }
    public function delete_cart($id)
    {
        $data = Cart::find($id);

        if ($data) {
            $data->delete();
        }
        toastr()->timeOut(10000)->closeButton()->addSuccess('Product retiré du panier');
        return redirect()->back();
    }

    public function update_qty_inc($id)
    {
        $edit = Cart::find($id);
        $produit = Product::find($edit->product_id);
        if ($produit->quantite >= $edit->quantite + 1) {
            $edit->quantite = $edit->quantite + 1;
            $edit->save();
        } else {

            toastr()->timeOut(1000)->closeButton()->addWarning('Vous avez atteint la quantite maximale');
        }
        return redirect()->back();
    }

    public function update_qty_desc($id)
    {
        $edit = Cart::find($id);
        if ($edit->quantite > 1) {
            $edit->quantite = $edit->quantite - 1;
            $edit->save();
        }
        return redirect()->back();
    }


    public function retraitView()
    {
        return view('walletClient.retrait');
    }
    public function retrait($result)
    {
        $user = User::findOrFail(Auth::user()->id);
        $SumEcono = $user->economies()->where('statut', 'valide')->sum('montant');

        if (Auth::user()->usertype == 'user') {

            if ($result == 'false') {

                $val =  $this->retraitTaux(20, $SumEcono);
                if ($val) {
                } else {
                    sweetalert()->error('Echec.');
                }

                return redirect()->back();
            } else {
                $val =   $this->retraitTaux(10, $SumEcono);
                if ($val) {
                } else {
                    sweetalert()->error('Echec.');
                }
            }
        } else {

            if ($user->solde <= 0) {
                toastr()->timeOut(10000)->closeButton()->addError('Compte vide !');

                if (Auth::user()->usertype == 'superadmin') {
                    return  view('superadmin.wallet');
                }

                return view('seller.walletVendeur');
            }

            $tranfert = new Tranfert();
            $tranfert->auteur_id = Auth::user()->id;
            $tranfert->montant = $user->solde;
            $tranfert->type = 'retrait';
            $user->solde = 0;
            $user->save();
            $tranfert->save();
        }

        if (Auth::user()->usertype == 'superadmin') {
            return  view('superadmin.wallet');
        }
        return  view('seller.walletVendeur');
    }


    public function retraitTaux($taux, $SumEcono)
    {
        $economie = Economie::where('user_id', Auth::user()->id)->get();
        //
        $t = 1;
        if ($taux == 20) {
            $t = 4;
        }

        if ($SumEcono < 5000) {
            sweetalert()->warning('Votre solde economique est inferieure a 5000 Fcfa.');
            return false;
        }
        $tranfert = new Tranfert();
        $tranfert->auteur_id = Auth::user()->id;
        $tranfert->montant = $SumEcono - $SumEcono * $taux / 100;
        $tranfert->type = 'retrait';
        $tranfert->save();
        $superA = User::where('usertype', 'superadmin')->first();
        $superA->solde = $superA->solde +  $SumEcono * 3 * $t / 100;
        $superA->save();

        //repartition de la somme au different vendeur
        foreach ($economie as $e) {
            $vendeur = $e->product->user;
            $vendeur->solde = $vendeur->solde + ($e->montant * 2 * $t / 100);
            $vendeur->save();
        }

        sweetalert()->success('Retrait de ' . $SumEcono . ' Fcfa effectué avec success.');

        //
        foreach ($economie as $item) {
            $item->statut = 'expired';
            $item->save();
        }
        return true;
    }
}
