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

 $ec= $cmd2->economies()->first();
$client=User::findOrFail($ec->user_id);

@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/admin.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/boxicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('New_pages/fivhier_css/fact.css')}}">
    <style>
        li {
            margin-left: 18px;
        }

        a i {
            margin-right: 9px;
        }
    </style>


    <title>Document</title>
</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">

        <ul class="side-menu top">


            <a href="#" class="brand">

                <div class="profile">
                    <img src="@if(Auth::user()->photo!=''){{url('/')}}/photosUsers/{{Auth::user()->photo }} @else {{url('/')}}/avatar.png @endif" alt="Photo de profil">
                    <h4>{{Auth::user()->name}}</h4>
                </div>
            </a>


            <li style="margin-top:90px">
                <a href="{{url('superadmin/dashboard')}}">
                    <i class='fa fa-table'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            <li class="bou">
                <a href="{{route('superadmin.admin')}}">
                    <i class="fa fa-users-cog"> </i>
                    Manager


                </a>
            </li>

            <li>
                <a href="{{route('superadmin.vendeur')}}">
                    <i class='fa fa-store'></i>
                    <span class="text">Vendeur</span>
                </a>
            </li>
            <li>
                <a href="{{route('superadmin.client')}}">
                    <i class='fa fa-users'></i>
                    <span class="text">Clients</span>
                </a>
            </li>
            <li class="active">
                <a href="{{route('superadmin.commande')}}">
                    <i class='fa fa-list'></i>
                    <span class="text">Commandes</span>
                </a>
            </li>
            <li>
                <a href="{{route('viewVerificationWallet')}}">
                    <i class='fa fa-wallet'></i>
                    <span class="text">Wallet</span>
                </a>
            </li>
            <li><a href="{{route('profile.edit')}}">
                    <i class="fas fa-cog"></i>
                    <span class="nav-item">Profile</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">

            <li>
                <a class="logout">
                    <form method="POST" action="{{ route('logout') }}" style="display: flex;flex-direction:row;align-content:center;">
                        @csrf
                        <i class='fas fa-sign-out-alt'></i>
                        <div :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            <span class="text"> {{ __('Log Out') }}</span>

                        </div>
                    </form>
                </a>

            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->


    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <a href="#" class="nav-link">Categories</a>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">5</span>
            </a>
            <a href="#" class="profile">
                <img src="{{asset('New_Pages/image/add employee3.png')}}">
            </a>
        </nav>
        <!-- NAVBAR -->

        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Profile</h1>

                </div>


            </div>



            @include('superadmin.recap')

            <div class="activity">
                <div class="facture" style="margin-top:15px">
                    <header>
                        <h1>FACTURE </h1>
                        <p>{{$cmd2->created_at}}</p>
                        @php
                        $info1=$cmd2->created_at;
                        @endphp
                    </header>
                    <div class="entreprise">
                        <h2>LA VOIE NUMÉRIQUE</h2><br><br>
                        <p>Nom:  {{$client->name}}</p>
                        <p>Téléphone client: {{$client->telephone}}</p>
                        <p>Adresse client: {{$client->email}}</p>
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
                        <input type="hidden" name="idClient" value="{{$client->id}}">

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

        </main>
        <script src="{{asset('New_Pages/js/Scriptdash.js')}}"></script>
</body>

</html>