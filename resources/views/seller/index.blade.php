@php
use App\Models\User;
use App\Models\Product;
use App\Models\Economie;
use App\Models\Commande_Product;
use App\Models\Commande;
use Illuminate\Support\Facades\Auth;
$index=0;
$listeCommande=array();
$donne=Commande_Product::whereHas('product',
function($query){
$query->where('seller_id',Auth::user()->id);
})->orderBy('created_at','desc')->get();
$color=0;
@endphp

@php
foreach($donne as $count)
{

if(in_array($count->commande_id,$listeCommande)===false)
{
array_push($listeCommande,$count->commande_id);
}
}

$userTest=User::findOrFail(Auth::user()->id);
if($userTest->forfait->statut=='impayer')
{
if($userTest->forfait->dette>0 && $userTest->forfait->type!='inscrit')
{
	sweetalert()->warning('Vos avez des aérés de '.$userTest->forfait->dette.' mois a payer .Veuiilez les contacter pour plus d \'information');
}
if($userTest->forfait->type=='inscrit')
{
	sweetalert()->addSuccess('Votre inscription est en cour de validation');
}

}

@endphp

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/dashVendeur.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
	<link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/boxicons.min.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
	<title>Document</title>
</head>
<style>
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

	td,
	th {
		flex: 1;
	
		height: 100%;
		align-items: center;
		align-content: center;
		text-align: center;
	}
	tr
        {
            min-width:1000px;
        }
	th {
		font-size: larger;
		color: #FF8000
	}
</style>

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
	@include('seller.sidebar')
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
		
		</nav>
		
		<!-- NAVBAR -->

		<main>
			<div class="head-title">
				<div class="left">
					<h1>Acceuil</h1>
					<ul class="breadcrumb">

					</ul>
				</div>

			</div>

			@include('seller.recap')


			<div class="activity">
				<div class="title">
					<i class="uil uil-clock-three"></i>
					<span class="text">Commandes Recentes</span>
				</div>
				<div class="cont1">
					<div class="data ID">
						<table>
							<theader>
								<tr class="ligneCommande" style="height:40px;font-weight:bolder;margin-top:20px">
									<th><span class="data-title">ID</span></th>
									<th><span class="data-title">Date</span></th>
									<th><span class="data-title">Client</span></th>
									<th><span class="data-title">Telephone</span></th>
									<th><span class="data-title">Quantite Produit</span></th>
									<th><span class="data-title">Montant</span></th>
									<th><span class="data-title">Epargne</span></th>
									<th><span class="data-title">Imprimer</span></th>
								</tr>
							</theader>
							<tbody>
								@foreach ($listeCommande as $item)
								@php
								$commande=Commande::findOrFail((int)$item);
								$client=User::findOrFail($commande->user_id);

								$lesEconomie=Economie::whereHas('commande',
								function($query)use($commande){
								$query->where('commande_id', $commande->id);
								})->get();

								$prixTotal=0;

								foreach( $lesEconomie as $economie)
								{
								$prixTotal += $economie->product->prix*$economie->quantite;

								}
								@endphp

								<tr class="ligneCommande" @if ($color==0) style="background-color:  #F9F9F9;" @endif>
									<td> <span class="data-list">{{$index=$index+1}}</span></td>
									<td><span class="data-list">{{$commande->created_at}}</span></td>
									<td><span class="data-list">{{$client->name}}</span></td>
									<td><span class="data-list">{{$client->telephone}}</span></td>
									<td><span class="data-list">{{Economie::where('commande_id',$item)->count()}} </span></td>
									<td><span class="data-list">{{$prixTotal}} Fcfa</span></td>
									<td><span class="data-list">{{Economie::where('commande_id',$item)->sum('montant')}} Fcfa</span></td>
									<td><span class="data-list">
											<a href="{{route('seller.factureClient',$commande->id)}}"> <i class='fa fa-print' style="font-size:24px"></i></a>
										</span>
									</td>
								</tr>
								@php
								if($color==0){$color=1;}else{$color=0;}
								@endphp

								@endforeach

							</tbody>
						</table>

					</div>
				</div>

			</div>

		</main>
		<script src="{{asset('New_Pages/js/Scriptdash.js')}}"></script>
</body>

</html>