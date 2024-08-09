@php
use App\Models\Product;
use App\Models\Economie;
use App\Models\User;
use App\Models\Commande;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
$dataeconomie = Economie::where('commande_id',(int)$commande->id)->get();
$payer=0;
$epargne=0;

$photoInfo=array();
$nomInfo=array();
$quantiteInfo=array();
$tauxInfo=array();
$prixInfo=array();
$epargneInfo=array();
$info1;
$info2;
$info3;
$info3;
@endphp



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/dashVendeur.css')}}">
    <link rel="stylesheet" href="{{asset('New_pages/fivhier_css/fact.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/boxicons.min.css')}}">
    <title>Document</title>
</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <!-- <i class='bx bxs-smile'></i>
			<span class="text">Levegi</span> -->
            <div class="photo-container">
                <img id="photo-preview" src="@if(Auth::user()->photo!=''){{url('/')}}/photosUsers/{{Auth::user()->photo }} @else {{url('/')}}/avatar.png @endif" alt="Photo de profil">

            </div>
        </a>
        <ul class="side-menu top">
			<h2 style="text-align:center;color:#FF8000">{{Auth::user()->name}}</h2>
			<li >
				<a href="{{url('seller/dashboard')}}"  style="justify-content:flex-start;gap: 11px;">
					<i class='fa fa-th-large' style="margin-left:10px;"></i>
					<span class="text" >Dashboard</span>
				</a>
			</li>
			<li>
				<a href="{{route('ajouterCategorieprod')}}" style="justify-content:flex-start;gap: 11px;">
					<i class='fa fa-list-alt' style="margin-left:10px;"></i>
					<span class="text">Categorie</span>
				</a>
			</li>
			<li>
				<a href="{{route('afficheProduit')}}"  style="justify-content:flex-start;gap: 11px;">
				<i class="fa fa-book" aria-hidden="true" style="margin-left:10px;color:black"></i>
					<span class="text">Produits</span>
				</a>
			</li>
			<li>
				<a href="{{route('afficheclient')}}" style="justify-content:flex-start;gap: 11px;">
					<i class='fa fa-users' style="margin-left:10px;"></i>
					<span class="text">Clients</span>
				</a>
			</li>
			<li class="active">
				<a href="{{route('affichecommande')}}" style="justify-content:flex-start;gap: 11px;">
					<i class='fa fa-credit-card' style="margin-left:10px;"></i>
					<span class="text">Commandes</span>
				</a>
			</li>

			<li>
				<a href="{{route('viewVerificationWallet')}}" style="justify-content:flex-start;gap: 11px;">
					<i class='fas fa-wallet' style="margin-left:10px;"></i>
					<span class="text">Wallet</span>
				</a>
			</li>
            <li><a href="{{route('contact')}}" style="justify-content:flex-start;gap: 11px;">
                    <i class='fa fa-phone' style="margin-left:10px;"></i>
                    <span class="nav-item">Contactez -nous</span>
                </a>
            </li>
			<li><a href="{{route('profile.edit')}}" style="justify-content:flex-start;gap: 11px;">
					<i class="fa fa-user" style="margin-left:10px;"></i>
					<span class="nav-item">Profile</span>
				</a>
			</li>
		</ul>
        <ul class="side-menu">
           
            <li>
                <a class="logout">
                    <form method="POST" action="{{ route('logout') }}" style="display: flex;flex-direction:row;align-content:center;">
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
    </section>
    <!-- SIDEBAR -->


    <!-- CONTENT -->
    <section id="content">
    <!-- NAVBAR -->
		<nav>
			
			<a href="#" class="nav-link"></a>
			<a href="#" class="profile">
				
			</a>
		</nav>
		<!-- NAVBAR -->

        <main>
            <div class="head-title">
                <div class="left">

                    <ul class="breadcrumb">

                    </ul>
                </div>

            </div>
            @php

            @endphp
            @include('seller.recap')

            <div class="activity" id="imp">
                <!-- body -->
                <div class="facture" style="margin-top:12px">
                    <header style="text-align:center">
                        <h1>FACTURE </h1>
                        <p>{{$commande->created_at}}</p>
                        @php
                        $info1=$commande->created_at;
                        @endphp

                    </header>
                    <div class="entreprise">
                        @php
                        $idUser=0;
                        $economie=Economie::where('commande_id',$commande->id)->first()->get();
                        foreach( $economie as $eco){ $idUser=$eco->user_id;}

                        $client=User::findOrFail($idUser);
                        $info2= $client->id;
                        @endphp
                        <h2></h2>

                        <p> <b>Client:</b> {{ $client->name}}</p>
                        <p><b>Téléphone client:</b> {{ $client->telephone}}</p>
                        <p><b>Adresse client: </b>{{ $client->email}}</p>
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
                            @foreach ($dataeconomie as $row )

                            @php
                            $produit = Product::findOrFail($row->product_id);
                            if( $produit->seller_id==Auth::user()->id)
                            {
                            $payer+=$produit->prix*$row->quantite;
                            $epargne+=$row->montant;
                            }
                            @endphp

                            @if ( $produit->seller_id==Auth::user()->id)
                            <tr>
                                <td><img src="{{url('/')}}/photoProduit/{{$produit->photo }}" width="90" height="90" /></td>
                                <td>{{ $produit->nom }}</td>
                                <td>{{$row->quantite}}</td>
                                <td>{{$row->taux}}</td>
                                <td>{{$produit->prix*$row->quantite}} FCFA</td>
                                <td>{{$row->montant}} FCFA</td>

                                @php
                                array_push( $photoInfo, $produit->photo);
                                array_push($nomInfo,$produit->nom);
                                array_push($quantiteInfo,$row->quantite);
                                array_push($tauxInfo, $row->taux);
                                array_push($prixInfo,$produit->prix * $row->quantite);
                                array_push($epargneInfo,$row->montant);
                                @endphp

                            </tr>
                            @endif

                            @endforeach

                        </table>
                    </div>
                    <div class="total" style="text-align:right">
                        <p>TOTAL Payer : {{$payer}} Fcfa</p>
                        <p>TOTAL Epargne : {{$epargne}} Fcfa</p>
                        @php
                        $info3=$payer;
                        $info4=$epargne;
                        @endphp
                    </div>
                    <footer>
                        <p><b> Boutique :</b>{{Auth::user()->name}}</p>
                        <!-- <p>sitevraimentsuper.fr</p> -->
                        <p><b>Email :</b>{{Auth::user()->email}}</p>
                        <p>{{Auth::user()->localisation}}</p>
                        <p><b>Telephone :</b>{{Auth::user()->telephone}} </p>
                        <h2>Merci pour votre achat</h2>

                    </footer>
                </div>

            </div>
            <form method="post" action="{{route('seller.impression')}}">
                @csrf

                <input type="hidden" name="info1" value="{{$info1}}">
                <input type="hidden" name="info2" value="{{$info2}}">
                <input type="hidden" name="info3" value="{{$info3}}">
                <input type="hidden" name="info4" value="{{$info4}}">

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


                <a class=" btn-add" style="margin:auto;margin-top:15px;">
                    <button class="btn-add" style="font-size:14px;border:solid 2px #FF8000;text-decoration:none;outline:none">
                        <span class="text" style="font-size:14px;">Imprimer <i class='fa fa-print' style="font-size:14px"></i></span>
                    </button>
                </a>
            </form>

        </main>




        <script src="{{asset('New_Pages/js/Scriptdash.js')}}"></script>
</body>

</html>