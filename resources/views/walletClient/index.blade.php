@php
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use App\Models\Economie;
use App\Models\Commande;
use App\Models\Tranfert;

if(isset($count)===false)
{
$count =Cart::where('user_id',Auth::user()->id)->count();
}

@endphp
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar et Cards</title>
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/boutique2.css')}}">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/InscriptionVendeur.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/dur.css')}}">
</head>
<style type="text/css">
    .pannier:hover {
        color: #FF8000;
    }

    .panier {
        font-size: 40px;
        margin-left: 50%;
        margin-top: 15px;
    }

    .block2 {
        height: 500px;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 8%;
        justify-content: center;
        margin-left: auto;
        margin-right: auto;
        margin-top: 50px;
        width: 55%;
    }



    /* Default styles (for larger screens) */
    @media screen and (max-width: 500px) {

        .block2 {
            grid-template-columns: repeat(1, 1fr);
            gap: 8px;
            margin-left: auto;
            margin-right: auto;
        }

        .panier {
            margin-right: auto;
            margin-left: 25%;
            font-size: 30px;
        }

        .recherche {
            width: 150px;
            margin-left: 72%;
            margin-top: -5%;
        }


    }

    /* Extra large devices (large desktops, 1200px and up) */
    @media (max-width: 1450px) {
        .block2 {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .panier {
            font-size: 25px;
            margin-left: 10%;
        }

        .recherche {
            width: 250px;
            margin-left: 65%;
            margin-top: -2%;
        }
    }

    /* Large devices (desktops, 992px and up) */
    @media (max-width: 1000px) {
        .block2 {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .panier {
            font-size: 25px;
            margin-left: 15%;
        }

        .recherche {
            width: 200px;
            margin-left: 68%;
            margin-top: -3%;
        }
    }

    .ligne {
        display: inline-flex;
        width: 45cqmax;
        background: gray;
        gap: 7%;
        justify-content: space-around;
        height: 30px;
        border-radius: 9px;
        align-items: center;
        margin-bottom: 8px;
    }

    .ligneCommande {
        display: inline-flex;
        width: 100%;
        background: #e4d7d7;
        gap: 7%;
        font-size: small;
        justify-content: space-around;
        height: 30px;
        border-radius: 9px;
        align-items: center;
        margin-top: 18px;
    }

    .white {
        color: white
    }
    td,th
    {
        flex: 1;
        border: 1px solid white;
        height: 100%;
        align-items: center;
        align-content: center;
        text-align: center;
    }
    th
    {
        font-size:larger; 
        color:#FF8000
    }
    /* Medium devices (tablets, 768px and up) */
    @media (max-width: 778px) {
        .block2 {
            grid-template-columns: repeat(1, 1fr);
            gap: 10px;
        }

        .panier {
            font-size: 28px;
            margin-left: 20%;
        }

        .recherche {
            width: 180px;
            margin-left: 70%;
            margin-top: -4%;
        }
    }

    /* Small devices (phones, 500px and down) */
    @media (max-width: 500px) {
        .block2 {
            grid-template-columns: repeat(1, 1fr);
            gap: 8px;
            margin-left: auto;
            margin-right: auto;
        }

        .panier {
            margin-right: auto;
            margin-left: 25%;
            font-size: 30px;
        }

        .recherche {
            width: 150px;
            margin-left: 72%;
            margin-top: -5%;
        }
    }
</style>

<body>
    <div class="container">
        <div class="sidebar" id="sidebar">
            <div class="profile">
                <!-- <img src="{{asset('New_Pages/image/pexels-photo-2034541.png')}}" alt="Photo de profil"> -->
                <img src="@if(Auth::user()->photo!=''){{url('/')}}/photosUsers/{{Auth::user()->photo }} @else {{url('/')}}/avatar.png @endif" alt="Photo de profil">
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
                    <li><a href="">
                            <i class="fas fa-wallet"></i>
                            <span class="nav-item">Wallet</span>
                        </a></li>
                    <li>
                        <a class="logout">

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
                <div class="panier">
                    <a href="{{url('mycart')}}"><i class=" fa fa-shopping-cart pannier" style="color:white;" aria-hidden="true"> {{$count}} </i></a>
                </div>
            </div>
            <div class="recherche">
                <!-- <input class="research" type="search" placeholder="Effectuer une recherche..."> -->
                <div class="recherche">
                    <div class="input-box" style="margin-top:-25%">
                        <input type="tel" required>
                        <label class="lablllu">Recherche</label>
                    </div>
                </div>
            </div>
            <div class="cards">
                <div class="card" style="align-content:center;text-align:center;background:white;width:30%;height:100px;box-shadow: 0 0 20px red;font-weight:bold;font-size:16px">
                    Solde Wallet <br><br>
                    <h3 style="font-weight:bold;font-size:18px;color:#FF8000"> {{Auth::user()->solde}}FCFA</h3>

                </div>
                @php
                $user=User::findOrFail(Auth::user()->id);
                $SumEcono=$user->economies()->where('statut','valide')->sum('montant');
                @endphp
                <div class="card" style="align-content:center;text-align:center;background:white;width:30%;height:100px;box-shadow: 0 0 20px red;font-weight:bold;font-size:16px">
                    Economies <br><br>
                    <h3 style="font-weight:bold;font-size:18px;color:#FF8000"> {{$SumEcono}}FCFA</h3>

                </div>
            </div>
            <!--  -->

            <div class="block" style="width:80%;margin-left:auto;margin-right:auto">
                <div class="block">
                    <div class="cards" style="background:white;border-radius:12px;width:100%;height:auto;display:flex;flex-direction:column">
                        <div style="display:inline-flex;align-content:center;align-items:center;width:100%;justify-content:space-between;height:max-content">
                            <h4>Transactions recents</h4> <a href="{{route('recharge.index')}}" style="text-decoration:none"> <button style="width:100px;color:white;font-weight:bold;background:#FF8000">Recharge</button></a>
                        </div>
                        @php
                        $tranfert=Tranfert::where('auteur_id',Auth::user()->id)->latest()->get();
                        @endphp
                        @foreach ( $tranfert as $t)
                        <div class="ligne">
                            <!-- <h5>678 34 90 10</h5> -->
                            <h5>{{$t->created_at}}</h5>
                            <h5>{{$t->montant}} FCFA</h5>
                            <h5 class="white">{{$t->type}}</h5>
                        </div>
                        @endforeach

                        <div style="display:inline-flex;align-content:center;align-items:center;width:100%;justify-content:space-between;height:max-content;margin-top:20px">
                            <h4>Commandes recents</h4> <a   href="{{route('wallet.retraitView')}}" style="text-decoration:none"> <button style="width:100px;color:white;font-weight:bold;background:#FF8000">Retrait</button></a>
                        </div>
                        <table>
                            <theader>
                                <tr class="ligneCommande">
                                    <th>
                                        <h5>Date</h5>
                                    </th>
                                    <th>
                                        <h5>Nombre de produit</h5>
                                    </th>
                                    <th>
                                        <h5>Produit * Quantite</h5>
                                    </th>
                                    <th>
                                        <h5>Prix Total</h5>
                                    </th>
                                    <th>
                                        <h5>Epargne</h5>
                                    </th>
                                    <th>
                                        <h5 class="white">Imprimer</h5>
                                    </th>
                                </tr>
                            </theader>
                            <tbody>
                                @php
                                $listeCommande=$user->commandes()->latest()->get();
                                @endphp
                                <!--  -->
                                @foreach ($listeCommande as $item)
                                @php
                                $lesEconomie= $item->economies()->get();
                                $prixTotal=0;

                                foreach( $lesEconomie as $economie)
                                {
                                $prixTotal += $economie->product->prix*$economie->quantite;

                                }

                                @endphp

                                <tr class="ligneCommande">
                                    <td>
                                        <h5>{{$item->created_at}}</h5>
                                    </td>
                                    <td>
                                        <h5>{{Economie::where('commande_id',$item->id)->count()}}</h5>
                                    </td>
                                    <td>
                                        <h5>{{Economie::where('commande_id',$item->id)->sum('quantite')}}</h5>
                                    </td>
                                    <td>
                                        <h5>{{$prixTotal}} Fcfa</h5>
                                    </td>
                                    <td>
                                        <h5>{{Economie::where('commande_id',$item->id)->sum('montant')}}Fcfa</h5>
                                    </td>
                                    <td>
                                        <h5>
                                            <a href="{{route('voirCommande.detail',$item->id)}}"> <i class='fa fa-print' style="font-size:24px"></i></a>
                                        </h5>
                                    </td>
                                </tr>
                                @endforeach
                                <!--  -->
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
            <div class="block2"></div>
            <!--  -->
        </div>

    </div>
    <script src="{{asset('New_Pages/js/script.js')}}"></script>

</body>

</html>