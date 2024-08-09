<?php

namespace App\Http\Controllers;

use App\Models\categorieProduit;
use App\Models\Product;
use App\Models\Tranfert;
use App\Models\User;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

  public function index()
  {
    return view('superadmin.index');
  }

  public function ajouterManager()
  {

    return view('superadmin.ajouterManager');
  }

  public function indexadmin()
  {
    return view('admin.index');
  }



  public function adminprofile()
  {
    return view('admin.profile');
  }

  public function ajouteVueVendeur()
  {

    return view('admin.ajoutVendeur');
  }

  public function indexseller()
  {
    return view('seller.index');
  }
  public function walletVendeur()
  {
    return view('seller.walletVendeur');
  }
  public function afficheclient()
  {
    return view('seller.client');
  }
  public function afficheeconomie()
  {
    return view('seller.economie');
  }
  public function affichecommande()
  {
    return view('seller.commande');
  }

  public function contact()
  {
    return view('Contact.index');
  }
  public function super_admin()
  {
    return view('superadmin.admin');
  }
  public function super_client()
  {
    return view('superadmin.client');
  }
  public function super_vendeur()
  {
    return view('superadmin.vendeur');
  }
  public function super_commande()
  {
    return view('superadmin.commandes');
  }
  public function admin_vendeur()
  {
    return view('admin.vendeur');
  }

  public function detailProduit($id)
  {
    $produit = Product::find($id);
    return view('detailProduit', compact('produit'));
  }


  public function ajouterProduit()
  {
    $title = "Enregistrer";
    $data = CategorieProduit::where('seller_id', Auth::user()->id)->orderBy('nom', 'asc')->get();
    return view('seller.ajouterproduit', compact('data', 'title'));
  }

  public function ajouterCategorieprod()
  {
    //  $data=Cate
    $title = 'Ajouter';
    $data = CategorieProduit::where('seller_id', Auth::user()->id)->orderBy('nom', 'asc')->get();

    return view('seller.ajouterCategorieProduit', compact('data', 'title'));
  }


  public function listeproduit()
  {
    $data = Product::where('seller_id', Auth::user()->id)->orderBy('nom', 'asc')->get();
    $datanamecatg = CategorieProduit::all();
    return view('seller.listingProduit2', compact('data', 'datanamecatg'));
  }

  public function visiteboutique($seller_id)
  {
    $Produitboutique = Product::where('seller_id', $seller_id)->orderBy('nom', 'asc')->get();
    return view("test", compact("Produitboutique", 'seller_id'));
  }
  public function vuefacture($id)
  {
    $commande = Commande::findOrFail((int)$id);
    return view('seller.factureClient', compact('commande'));
  }

  public function boutiqueCategorie($categorie)
  {
    $data = User::where('categorie', '=', $categorie)
      ->where('usertype', '=', 'seller')
      ->get();
    return view(' boutiqueCategorie', compact('data','categorie'));
  }

  public function ValidationCommandeWallet(Request $request)
  {
    $quantite = $request->quantite;
    $epargne = $request->epargne;
    $prixtotal = $request->prixtotal;

    return view('ValidationCommande', compact('quantite', 'epargne', 'prixtotal'));
  }
  public function Affichesolde(Request $request)
  {
    $quantite = $request->quantite;
    $epargne = $request->epargne;
    $prixtotal = $request->prixtotal;

    // Vérifier l'authentification de l'utilisateur
    if (!Auth::attempt(['email' => Auth::user()->email, 'password' => $request->motdepass])) {
      // Si l'authentification échoue
      toastr()->error('Mot de passe incorrect');
      return view('ValidationCommande', compact('quantite', 'epargne', 'prixtotal'));
    }

    // Si l'authentification réussit
    $vald = 'true';
    return view('ValidationCommande', compact('quantite', 'epargne', 'prixtotal', 'vald'));
  }

  public function indexRecharge()
  {
    return view('cart.index');
  }

  public function RechargeSolde(Request $request)
  {
    $user = User::findOrFail(Auth::user()->id);
    $user->solde = $user->solde + $request->amount;
    $transantion = new Tranfert();
    $transantion->type = 'depot';
    $transantion->auteur_id = Auth::user()->id;
    $transantion->montant = $request->amount;

    $transantion->save();
    $user->save();
    return view('dashboard');
  }


  public function viewVerificationWallet()
  {
    return view('MotdepasseWallet');
  }

  public function MotdePasseWallet(Request $request)
  {

    // Validation du formulaire
    $request->validate([
      'password' => 'required|string',
    ]);

    $user = Auth::user();
    $inputPassword = $request->input('password');

    // Vérification du mot de passe
    if (Hash::check($inputPassword, $user->password)) {

      if (Auth::user()->usertype == 'user') {
        return view('walletClient.index');
      }
      if (Auth::user()->usertype == 'seller') {
        return view('seller.walletVendeur');
      }
      if (Auth::user()->usertype == 'superadmin') {
        return view('superadmin.wallet');
      }
    } else {
      // Si l'authentification échoue
      toastr()->error('Mot de passe incorrect');
      return redirect()->back();
    }
  }
}
