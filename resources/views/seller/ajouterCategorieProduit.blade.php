<!DOCTYPE html>
<html lang="en">
@php
use App\Models\User;
$userTest=User::findOrFail(Auth::user()->id);
@endphp

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/Economies.css')}}">
	<link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/boxicons.min.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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
			<li>
				<a href="{{url('seller/dashboard')}}" style="justify-content:flex-start;gap: 11px;">
					<i class='fa fa-th-large' style="margin-left:10px;"></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="active">
				<a href="{{route('ajouterCategorieprod')}}" style="justify-content:flex-start;gap: 11px;">
					<i class='fa fa-list-alt' style="margin-left:10px;"></i>
					<span class="text">Categorie</span>
				</a>
			</li>
			<li>
				<a href="{{route('afficheProduit')}}" style="justify-content:flex-start;gap: 11px;">
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
			<li>
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
			

			

		</nav>
		<!-- NAVBAR -->
		<main>
			<!-- l -->
			<div class="head-title">
				<div class="left">


				</div>

			</div>
			@include('seller.recap')

			<ul class="box-info">
				@if ($userTest->forfait->statut=='Bloquer'||$userTest->forfait->statut=='impayer')

				@if($userTest->forfait->type=='inscrit')
				<h2 style="color:green;font-size:19px"> Votre inscription est en cour de validation</h2>
				@else
				<h2 style="color:red;font-size:19px">Veuillez payer votre passe mensuelle</h2>
				@endif



				@else
				<div class="card">
					<form method="POST" action="@if (isset($edit->id)) {{route('categorieproduit.update',['id' => $edit->id]) }} @else {{ route('categorieproduit.insert') }} @endif">
						@csrf
						<div class="add">
							<input name="nom" id="nom" style="width:400px;height:40px;border:2px #FF8000 solid;margin-right:40px" value="@if(isset($edit->id)){{$edit->nom}}@endif" required />
							<button type="submit" href="" class="btn-add text" style="border:solid 2px #FF8000;text-decoration:none;outline:none" value="">
								<i class=" fa fa-plus" style="color:white; font-size:20px;" aria-hidden="true"></i>
								<div class="text" style="margin-left:20px;font-weight:bold;"> {{$title}}</div>
							</button>


						</div>
					</form>
				</div>
				@endif
			</ul>
			<!-- l -->
			<div class="head-title">
				<div class="left">
					<ul class="breadcrumb">
						</li>
						<li>

						</li>
					</ul>
				</div>
			</div>

			<div class="activity">


				<table class="tableau-style">
					<thead>
						<tr>

							<th>#</th>
							<th>Categoire nom </th>
							<th>Creer le </th>
							<th>Modifier</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody {{$index=0}}>
						@php
						if(isset($search))
						{
						$data=$search;
						}
						@endphp
						@foreach ($data as $item)
						<tr>

							<td>{{$index=$index+1}}</td>
							<td>{{$item->nom}}</td>
							<td>{{$item->created_at}}</td>
							<td>{{$item->updated_at}}</td>

							<td style="display:flex;flex-direction:row;">
								@if ($userTest->forfait->statut!='Bloquer'&& $userTest->forfait->statut!='impayer')
								<a href="{{route('categorieproduit.edit',$item->id)}}" class="btn" style="width:100px;margin-right:auto;margin-left:25%;">
									<span class="text"><i class=" fa fa-edit" style="color:#FF8000; font-size:28px;" aria-hidden="true"></i></span>
								</a>
								@endif
								<a onclick=" confirmation(event)" href="{{route('categorieproduit.delete',$item->id)}}" class="btn" style="width:100px;margin-right:auto;margin-left:auto;">
									<span class="text"> <i class=" fa fa-trash-alt" style="color:red; font-size:28px;" aria-hidden="true"></i></span>
								</a>
							</td>
						</tr>
						@endforeach

					</tbody>
				</table>


			</div>

		</main>
		<script type="text/javascript">
			function confirmation(ev) {
				ev.preventDefault();
				var urlToRedirect = ev.currentTarget.getAttribute('href');
				console.log(urlToRedirect);

				swal({
						title: "Avertissement",
						text: "Voulez vous vraiment supprimer cette categorie?",
						icon: "warning",
						buttons: true,
						dangerMode: true,

					})

					.then((willCancel) => {
						if (willCancel) {
							window.location.href = urlToRedirect
						} else {

						}
					});

			}
		</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>