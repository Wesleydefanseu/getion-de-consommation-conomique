@php
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use App\Models\Economie;
use Illuminate\Support\Facades\Auth;

if (isset($count) === false) {
$count = Cart::where('user_id', Auth::user()->id)->count();
}
$dataeconomie = Economie::where('commande_id', $cmd2->id)->get();
$payer = 0;
$epargne = 0;
$listevendeur = collect();
@endphp

@php
//Element d'impression

$listeproduit = array();
$photoInfo=array();
$nomInfo=array();
$quantiteInfo=array();
$tauxInfo=array();
$prixInfo=array();
$epargneInfo=array();




@endphp



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar et Cards</title>
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/boutique2.2.css')}}">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/InscriptionVendeur.css')}}">
    <link rel="stylesheet" href="{{asset('New_pages/fivhier_css/fact.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

</head>
<style>
    .btn-add {

        height: 40px;
        width: 200px;
        border-radius: 30px;
        background-color: #FF8000;
        color: white;
        border: none;
        cursor: pointer;
    }

    .le4 {
        font-size: 40px;
        margin-left: auto;
        margin-right: auto;
        margin-top: 15px;
    }

    @media screen and (max-width: 768px) {
        .humm {
            position:relative;
            margin-top: 200px;
        }

        .main-content {
            display: flex;
            flex-direction: column;
        }

        .ppProfil {

            margin-top: 50px;
            width: 200px;
            height: 200px;
            background-color: azure;
        }

        .menu__bar {
            width: 320%;
            flex: 1;
        }

    }

</style>


<body>
    <div class="container">
        <div class="sidebar" id="sidebar">
            <div class="profile">
                <!-- <img src="{{asset('New_Pages/image/pexels-photo-2034541.png')}}" alt="Photo de profil"> -->
                <img class="ppProfil" src="@if(Auth::user()->photo!=''){{url('/')}}/photosUsers/{{Auth::user()->photo }} @else {{url('/')}}/avatar.png @endif" alt="Photo de profil">
                <h2>{{Auth::user()->name}}</h2>
            </div>

            <nav>
                <ul>
                    <li><a href="{{url('/dashboard')}}">
                            <i class="fas fa-home">
                                <span class="nav-item">Home</span>
                            </i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-store" style="display:flex;flex-direction:row">
                                <span class="nav-item">Boutique</span>
                                <i class="fas fa-caret-down"></i>
                            </i>

                        </a>
                        <ul class="dropd" style="margin-top:20px;margin-left:-15px;">
                            <li><a href="{{route('boutiqueCategorie','Bronze')}}" style="display:flex;flex-direction:row"><i class="fas fa-medal" style="color:#CD7F32;font-size:16px;margin-right:40px;"></i> Bronze</a></li>
                            <li><a href="{{route('boutiqueCategorie','Argent')}}" style="display:flex;flex-direction:row"> <i class="fas fa-medal" style="color:#C0C0C0;font-size:16px;margin-right:40px;"></i>Argent</a></li>
                            <li><a href="{{route('boutiqueCategorie','Or')}}" style="display:flex;flex-direction:row"> <i class="fas fa-medal" style="color:#FFD700;font-size:16px;margin-right:40px;"></i>Or</a></li>
                            <li><a href="{{route('boutiqueCategorie','Platine')}}" style="display:flex;flex-direction:row"> <i class="fas fa-medal" style="color:#E5E4E2;font-size:16px;margin-right:40px;"></i>Platinium</a></li>

                        </ul>

                    </li>

                    <li><a href="{{route('profile.edit')}}">
                            <i class="fas fa-user"></i>
                            <span class="nav-item">Profile</span>
                        </a></li>
                    <li><a href="{{route('viewVerificationWallet')}}">
                            <i class="fas fa-wallet"></i>
                            <span class="nav-item">Wallet</span>
                        </a></li>
                    <li><a href="{{route('contact')}}">
                            <i class='fa fa-phone' style="margin-left: 15px;"></i>
                            <span class="nav-item">Contact</span>
                        </a>
                    </li>
                    <li class="humm">
                        <a class="logout humm">

                            <form method="POST" action="{{ route('logout') }}" style="display: flex;flex-direction:row;align-content:center;margin-top: -50px;">
                                @csrf
                                <i class="fas fa-sign-out-alt"></i>
                                <div :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </div>
                            </form>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>


        <div class="main-content">
            <div class="menu__bar">
                <div class="menu-icon" id="menu-icon" style="color: white;">&#9776;</div>
                <div class="le4">
                    <a href="{{url('mycart')}}"><i class=" fa fa-shopping-cart pannier" style="color:white;" aria-hidden="true"> {{$count}} </i></a>
                </div>
            </div>


            <div class="facture" style="margin-top:15px">
                <header>
                    <h1>FACTURE </h1>
                    <p>{{$cmd2->created_at}}</p>
                    @php
                    $info1=$cmd2->created_at;
                    @endphp
                </header>
                <div class="entreprise">
                    <h2>LA VOIE NUMÉRIQUE</h2>
                    <p>Téléphone client: {{Auth::user()->telephone}}</p>
                    <p>Adresse client: {{Auth::user()->email}}</p>
                </div>
                <div class="items">
                    <table>
                        <tr>
                            <th>Photo</th>
                            <th>Nom</th>
                            <th>Quantite</th>
                            <th>Taux en %</th>
                            <th>Prix</th>
                            <th>Epargne</th>
                        </tr>
                        @foreach ($dataeconomie as $row)

                        @php
                        $produit = Product::findOrFail($row->product_id);
                        $seller = User::findOrFail($produit->seller_id);

                        if (!$listevendeur->contains($seller)) {
                        $listevendeur->push($seller);
                        }

                        $payer += $produit->prix * $row->quantite;
                        $epargne += $row->montant;
                        @endphp
                        <tr>
                            <td><img src="{{url('/')}}/photoProduit/{{$produit->photo }}" width="90" height="90" /></td>
                            <td>{{$produit->nom}}</td>
                            <td>{{$row->quantite}}</td>
                            <td>{{$row->taux}}</td>
                            <td>{{$produit->prix * $row->quantite}} FCFA</td>
                            <td>{{$row->montant}} FCFA</td>
                        </tr>

                        @php
                        $pt = [
                        'photo' => $produit->photo,
                        'nom' => $produit->nom,
                        'quantite' => $row->quantite,
                        'taux' => $row->taux,
                        'prix' => $produit->prix * $row->quantite,
                        'epargne' => $row->montant,
                        ];

                        array_push($listeproduit, $pt);


                        $listeproduit = array();
                        array_push( $photoInfo, $produit->photo);
                        array_push($nomInfo,$produit->nom);
                        array_push($quantiteInfo,$row->quantite);
                        array_push($tauxInfo, $row->taux);
                        array_push($prixInfo,$produit->prix * $row->quantite);
                        array_push($epargneInfo,$row->montant);

                        @endphp

                        @endforeach

                    </table>
                </div>
                <div class="total" style="text-align:right">
                    <p>TOTAL Payer : {{$payer}} Fcfa</p>
                    <p>TOTAL Epargne : {{$epargne}} Fcfa</p>
                    @php
                    $info2=$payer;
                    $info3=$epargne;
                    @endphp
                </div>
                <footer>
                    @if(count($listevendeur) <= 1) @foreach ($listevendeur as $sel) <p>Boutique :{{$sel->name}}</p>
                        <!-- <p>sitevraimentsuper.fr</p> -->
                        <p>{{$sel->email}}</p>
                        <p>{{$sel->localisation}}</p>
                        <p>{{$sel->telephone}} </p>
                        <h2 style="color:black">Merci pour votre achat</h2>

                        @endforeach

                        @else
                        <p>Boutiques :</p>
                        @foreach ($listevendeur as $vendeur)
                        <p>{{$vendeur->name}} {{$vendeur->telephone}}</p>
                        @endforeach
                        @endif
                </footer>
            </div>
            <div class="facture" style="margin-top:15px;margin-left:auto;margin-right:auto;">
                <form action="{{route('client.impression')}}" method="POST">
                    @csrf

                    @foreach($listevendeur as $i)
                    <input type="hidden" name="listevendeur[]" id="listevendeur" value="{{$i->id}}">
                    @endforeach


                    <input type="hidden" name="info1" value="{{$info1}}">
                    <input type="hidden" name="info2" value="{{$info2}}">
                    <input type="hidden" name="info3" value="{{$info3}}">


                    @foreach($photoInfo as $i)
                    <input type="hidden" name="photoInfo[]" id="listeproduit" value="{{$i}}">
                    @endforeach

                    @foreach($nomInfo as $i)
                    <input type="hidden" name="nomInfo[]" id="listeproduit" value="{{$i}}">
                    @endforeach

                    @foreach($quantiteInfo as $i)
                    <input type="hidden" name="quantiteInfo[]" id="listeproduit" value="{{$i}}">
                    @endforeach

                    @foreach($tauxInfo as $i)
                    <input type="hidden" name="tauxInfo[]" id="listeproduit" value="{{$i}}">
                    @endforeach

                    @foreach($prixInfo as $i)
                    <input type="hidden" name="prixInfo[]" id="listeproduit" value="{{$i}}">
                    @endforeach

                    @foreach($epargneInfo as $i)
                    <input type="hidden" name="epargneInfo[]" id="listeproduit" value="{{$i}}">
                    @endforeach

                    <a class="btn-add" style="margin-top:15px;margin-left:auto;margin-right:auto;">
                        <button class="btn-add" type="submit">
                            <i class="fas fa-print" style="color:white;font-size:16px;margin-right:0px;"></i>
                            <span class="text">Imprimer</span>
                        </button>
                    </a>
                </form>
            </div>

        </div>

    </div>

    <script src="{{asset('New_Pages/js/script.js')}}"></script>
</body>

</html>