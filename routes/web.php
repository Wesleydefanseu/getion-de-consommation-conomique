<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\NewRegisterController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategorieProduitsController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ProfileController;
use Dompdf\Dompdf;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Impression;
use App\Http\Controllers\ImpressionController;
use App\Http\Controllers\PayementController;
use App\Http\Controllers\PhotosController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\WalletController;
//messagerie
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SearchVendeurController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    ///

Route::get('show-user-location-data', [LocationController::class, 'index']);
Route::get('redirectlogin', [RegisteredUserController::class, 'store']);
Route::get('superadmin/dashboard', [HomeController::class, 'index'])->name('superadmin.index');;
Route::get('admin/dashboard', [HomeController::class, 'indexadmin'])->name('admin.index');
Route::get('seller/dashboard', [HomeController::class, 'indexseller'])->name('seller.index');
Route::post('Client/ValidationCommande', [HomeController::class, 'ValidationCommandeWallet'])->name('client.ValidationCommande');


//
Route::get('ajouterProduit', [HomeController::class, 'ajouterProduit'])->name('ajouterProduit');

Route::get('ajouterManager', [HomeController::class, 'ajouterManager'])->name('ajouterManager');
Route::post('/store', [NewRegisterController::class, 'store'])->name('superadmin.insert');
//afficheProduit

Route::get('afficheProduit', [HomeController::class, 'listeproduit'])->name('afficheProduit');
Route::get('ajouteVueVendeur', [HomeController::class, 'ajouteVueVendeur'])->name('ajouteVueVendeur');
Route::get('vendeur/client', [HomeController::class, 'afficheclient'])->name('afficheclient');
Route::get('vendeur/economie', [HomeController::class, 'afficheeconomie'])->name('afficheeconomie');
Route::get('vendeur/commande', [HomeController::class, 'affichecommande'])->name('affichecommande');
Route::get('ajouterCategorieprod', [HomeController::class, 'ajouterCategorieprod'])->name('ajouterCategorieprod');
Route::get('walletVendeur', [HomeController::class, 'walletVendeur'])->name('seller.walletVendeur');
Route::post('/ajout/produit/categorie', [CategorieProduitsController::class, 'store'])->name('categorieproduit.insert');

Route::get('/edit/{id}', [CategorieProduitsController::class, 'edit'])->name('categorieproduit.edit');
Route::post('/update/{id}', [CategorieProduitsController::class, 'update'])->name('categorieproduit.update');
Route::get('/delete/{id}', [CategorieProduitsController::class, 'delete'])->name('categorieproduit.delete');
//
Route::get('/editp/{id}', [ProductController::class, 'edit'])->name('produit.edit');
Route::post('/updatep/{id}', [ProductController::class, 'update'])->name('produit.update');
Route::get('/deletep/{id}', [ProductController::class, 'delete'])->name('produit.delete');
//
Route::post('/produit/store', [ProductController::class, 'store'])->name('produit.insert');
//
Route::get('mycart', [CartController::class, 'mycart']);
Route::get('add_cart/{id}', [CartController::class, 'add_cart']);
Route::get('delete_cart/{id}', [CartController::class, 'delete_cart']);
Route::get('update_qty_inc/{id}', [CartController::class, 'update_qty_inc']);
Route::get('update_qty_desc/{id}', [CartController::class, 'update_qty_desc']);
Route::get('boutique/super/detail/{id}', [SuperAdminController::class, 'detailboutique'])->name('boutique.detail');
//
Route::get('superadmin/admin', [HomeController::class, 'super_admin'])->name('superadmin.admin');
Route::get('superadmin/client', [HomeController::class, 'super_client'])->name('superadmin.client');
Route::get('superadmin/vendeur', [HomeController::class, 'super_vendeur'])->name('superadmin.vendeur');
Route::get('superadmin/commande', [HomeController::class, 'super_commande'])->name('superadmin.commande');
Route::get('admin/vendeur', [HomeController::class, 'admin_vendeur'])->name('admin.vendeur');

//
Route::post('client/commande/valider', [CommandeController::class, 'validerAchat'])->name('commande.valider');
Route::get('validation', [CommandeController::class, 'validation']);
Route::get('/seller/commande/{id}', [HomeController::class, 'vuefacture'])->name('seller.factureClient');
//impression
Route::get('/client/recharge/auth', [HomeController::class, 'indexRecharge'])->name('recharge.index');

Route::post('/pdf/generate', [Impression::class, 'impression'])->name('seller.impression');
Route::post('/impression/client/', [ImpressionController::class, 'impression'])->name('client.impression');

Route::post('client/affichesolde', [HomeController::class, 'Affichesolde'])->name('client.affichesolde');

Route::get('boutiqueCategorie/{id}', [HomeController::class, 'boutiqueCategorie'])->name('boutiqueCategorie');
Route::post('client/RechargeSolde/', [HomeController::class, 'RechargeSolde'])->name('client.RechargeSolde');


//photo boutique

Route::post('seller/photos/add', [PhotosController::class,'seller'])->name('seller.photo.boutique');
//

Route::get('boutique/photo/delete/{id}', [ProductController::class, 'deleteTof'])->name('delete.photo');
//
Route::get('/client/detail/wallet', [WalletController::class, 'indexClient'])->name('client.wallet');
Route::get('voirCommande/detail/user/{id}', [CommandeController::class, 'voirCommande'])->name('voirCommande.detail');

Route::get('/client/wallet/retraitvue', [CartController::class,'retraitView'])->name('wallet.retraitView');
Route::get('/client/wallet/retraitFunction/{result}', [CartController::class,'retrait'])->name('wallet.retraitFunction');

Route::get('client/View/verification', [HomeController::class,'viewVerificationWallet'])->name('viewVerificationWallet');
Route::post('client/wallet', [HomeController::class,'MotdePasseWallet'])->name('client.verified.wallet');
//
Route::get('admin/profile/verification', [HomeController::class,'adminprofile'])->name('admin.profile');
Route::post('boutique/super/modifier', [SuperAdminController::class, 'modifierBoutique'])->name('superadmin.updateVendeur');
//
Route::get('Contact/view', [HomeController::class,'contact'])->name('contact');

Route::get('/superadmin/search/', [SearchController::class, 'superadminsearchTest'])->name('superadmin.search');
Route::get('/seller/search/', [SearchVendeurController::class, 'index'])->name('seller.search');

Route::post('Envoyer/Chat/text', [ChatController::class, 'saveMessage'])->name('chat.send')->middleware('auth');
});

    
require __DIR__ . '/auth.php';


//recherche 
Route::get('/search/dashboard', [SearchController::class, 'searchDashboard'])->name('search.dashboard');
Route::post('/search/boutiqueC', [SearchController::class, 'searchBoutiqueC'])->name('search.boutiqueC');
Route::get('/search/test', [SearchController::class, 'searchTest'])->name('search.test');

//detail produit
Route::get('/detailProduit/{id}', [HomeController::class, 'detailProduit'])->name('produit.detailProduit');

//visite boutique
Route::get('boutique/visite{seller_id}', [HomeController::class, 'visiteboutique'])->name('visiteboutique');
Route::get('boutique/Categorie/special/{id}', [ProductController::class, 'BoutiqueCategorieSpecial'])->name('boutique.categorie.speciale');
//

//messagerie 
Route::get('/messages/{id}', [MessageController::class, 'index'])->middleware('auth');
Route::post('/messages', [MessageController::class, 'store'])->middleware('auth');



Route::get('chat', [ChatController::class, 'index'])->middleware('auth');
Route::get('Chat/Messagerie/{id}', [ChatController::class, 'affichagemessage'])->middleware('auth');
Route::get('chat/vendeur/{id}', [ChatController::class, 'creeChatVendeur'])->middleware('auth');

