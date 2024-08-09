@php
use App\Models\PhotoProduit;
use App\Models\User;
$userTest=User::findOrFail(Auth::user()->id);
@endphp


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/AjouterProduitNew.css')}}">
	<link rel="stylesheet" href="{{asset('New_Pages/AjoutPhotoProduit/style.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
	<title>Ajouter Produit</title>
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
			<li>
				<a href="{{route('ajouterCategorieprod')}}" style="justify-content:flex-start;gap: 11px;">
					<i class='fa fa-list-alt' style="margin-left:10px;"></i>
					<span class="text">Categorie</span>
				</a>
			</li>
			<li class="active">
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

			<a href="#" class="nav-link"></a>
			<a href="#" class="profile">

			</a>
		</nav>
		<!-- NAVBAR -->

		<main>
			<div class="container1" style="display: grid;grid-template-columns: repeat(2, 1fr);justify-content: space-around">

				@if ($userTest->forfait->statut=='Bloquer'||$userTest->forfait->statut=='impayer')
				@if($userTest->forfait->type=='inscrit')
				<h2 style="color:green;font-size:19px"> Votre inscription est en cour de validation</h2>
				@else
				<h2 style="color:red;font-size:19px">Veuillez payer votre passe mensuelle</h2>
				@endif
				@else
				<form action="@if (isset($edit->id)) {{route('produit.update',['id' => $edit->id]) }} @else {{ route('produit.insert') }} @endif" method="post" enctype="multipart/form-data" style="display: grid;grid-template-columns: repeat(2, 1fr);justify-content: space-around">
					@csrf
					<div style="min-width: 400px;max-width: 400px;display: flex;flex-direction: column;padding: 20px;">

						<img id="preview" class="image" src="@if(isset($edit->id)){{url('/')}}/photoProduit/{{$edit->photo }} @else {{asset('New_Pages/image/levegi.jpeg')}} @endif" alt="Photo d'entete" onclick="openFileInput() ">
						<input class="" type="file" accept="image/*" style="display: none;" name="photto" onchange="displaySelectedImage(event) ">
						<input id="oldphoto" name="oldphoto" style="display:none" value="@if(isset($edit->id)){{$edit->photo}}@endif">
						<div class="form-group" style="margin-top:10px;">
							<input type="text" class="form-control" name="nom" id="nom" placeholder="Nom du produit" value="@if(isset($edit->id)){{$edit->nom}}@endif" required>
						</div>
						<div class="form-group">
							<textarea style="max-width: 370px;" type="text" class="form-control" placeholder="Description" name="description" id="description" required>@if(isset($edit->id)){{$edit->description}}@endif</textarea>
						</div>
						<div class="form-group">
							<input type="number" class="form-control" placeholder="Quantite en stock" name="qty" id="qty" placeholder="Quantite en stock" value="@if(isset($edit->id)){{$edit->quantite}}@endif" required>
						</div>
						<div class="form-group">
							<input type="number" class="form-control" id="y" placeholder="Entrez le prix Vendeurs" min="0" oninput="calculateValues()" required>
						</div>
						<div class="form-group">
							<input type="number" class="form-control" id="x" name="prix" placeholder="Entrez le prix Clients" min="0" oninput="calculateValues()" value="@if(isset($edit->id)){{$edit->prix}}@endif" required>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Economie du client" id="economie" readonly>
						</div>
						<div class="form-group">
							<input type="number" class="form-control" name="taux" id="taux" placeholder="Taux (en %)" value="@if(isset($edit->id)){{$edit->taux}}@endif" readonly>
						</div>
						<div class="form-group">
							<select class="form-control" style="background-color: white;color:black" name="categorie" id="categorie" value="@if(isset($edit->id)){{$edit->categorie}}@endif">
								@foreach ($data as $item)
								<option style="background-color: white;color:black" value="{{$item->id}}">{{$item->nom}}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group">
							<button type="submit" class="btn">{{$title}}</button>
						</div>
					</div>
					<div style="padding: 20px;">
						<div class="container" style="width: 400px;">
							<div id="add-photo-btn" style="background:#FF8000;border-radius:5px;color:aliceblue;height:40px;align-content:center;text-align:center"><b>Ajouter une Photo</b></div>
							<div id="photos-container">
								<div class="" style="margin-top:15px;display:grid;width:80%;height:auto ;grid-template-columns: repeat(2, 1fr);gap:15px">
									@if (isset($edit))
									@php
									$views=PhotoProduit::where('product_id',$edit->id)->get();
									@endphp

									@if($views)
									@foreach($views as $v)
									<div style="display:grid;width:10px;height:110px ;grid-template-columns: repeat(1, 1fr);margin-left:auto;margin-right:auto">
										<img src="{{url('/')}}/New_pages/AjoutPhotoProduit/photo/{{$v->imageV}}" width="80" height="80">
										<a href="{{route('delete.photo',$v->id)}}" style="text-decoration: none;max-width: 80px;">

											<i class=" fa fa-trash-alt" style="color:red; font-size:28px;background-color:#ff8000;width:80px;height:40px;margin-top:5px;border-radius:8px;align-content:center" aria-hidden="true"></i>

										</a>

									</div>
									@endforeach
									@endif
									@endif

								</div>
							</div>
						</div>
					</div>
				</form>
				@endif

			</div>

		</main>
		<script src="{{asset('New_Pages/js/Scriptdash.js')}}"></script>

</body>
<script>
	function Aucune() {
		if (document.getElementById("taux").value == '') {
			document.getElementById("y").value = '';
		}
	}
</script>
<script>
	function calculateValues() {
		const y = parseFloat(document.getElementById("y").value);
		const x = parseFloat(document.getElementById("x").value);

		if (!isNaN(y) && !isNaN(x) && y > 0 && x > 0 && x > y) {
			const t = (x - y) / (x * 0.01);
			const economie = (x * t) / 100;

			document.getElementById("taux").value = t.toFixed(2);
			document.getElementById("economie").value = economie.toFixed(2);
		} else {
			document.getElementById("taux").value = "";
			document.getElementById("economie").value = "";
		}
	}
</script>
<script type="text/javascript">
	function openFileInput() {
		document.querySelector('input[type="file"]').click();
	}

	function displaySelectedImage(event) {
		const fileInput = event.target;
		const previewImage = document.getElementById('preview');
		const file = fileInput.files[0];

		if (file) {
			const reader = new FileReader();
			reader.onload = function(e) {
				previewImage.src = e.target.result;
			};
			reader.readAsDataURL(file);
		}
	}
</script>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		const addPhotoBtn = document.getElementById('add-photo-btn');
		const photosContainer = document.getElementById('photos-container');

		let photoIndex = 0;

		addPhotoBtn.addEventListener('click', function() {
			const photoSection = document.createElement('div');
			photoSection.classList.add('photo-section');

			const input = document.createElement('input');
			input.type = 'file';
			input.name = `photoV[]`;
			input.accept = 'image/*';

			const img = document.createElement('img');
			img.src = '#'; // Placeholder for image

			const deleteBtn = document.createElement('button');
			deleteBtn.classList.add('delete-btn');
			deleteBtn.textContent = 'Del';

			deleteBtn.addEventListener('click', function() {
				photosContainer.removeChild(photoSection);
			});

			input.addEventListener('change', function() {
				const file = this.files[0];
				if (file) {
					const reader = new FileReader();
					reader.onload = function(e) {
						img.src = e.target.result;
					};
					reader.readAsDataURL(file);
				}
			});

			photoSection.appendChild(input);
			photoSection.appendChild(img);
			photoSection.appendChild(deleteBtn);

			photosContainer.appendChild(photoSection);

			photoIndex++;
		});
	});
</script>