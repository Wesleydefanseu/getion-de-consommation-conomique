<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8 ">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/Economies.css')}}">
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
            <li class="active">
            <a href="{{url('seller/dashboard')}}">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{route('afficheProduit')}}">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">Produits</span>
                </a>
            </li>
            <li>
                <a href="{{route('ajouterCategorieprod')}}">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">Categorie</span>
                </a>
            </li>
            <li>
                <a href="{{route('afficheclient')}}">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">Clients</span>
                </a>
            </li>
            <li>
				<a href="{{route('affichecommande')}}">
					<i class='bx bxs-message-dots'></i>
					<span class="text">Commandes</span>
				</a>
			</li>
		
            <li>
            <a href="{{route('seller.walletVendeur')}}">
                    <i class='bx bxs-group'></i>
                    <span class="text">Wallet</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li><a href="{{route('profile.edit')}}">
                    <i class="bx bxs-cog"></i>
                    <span class="nav-item">Profile</span>
                </a>
            </li>
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
            <!-- l -->
            <div class="head-title">
                <div class="left">


                </div>
                <div class="add">
                    <a href="" class="btn-add">
                        <span class="text">Ajouter</span>
                    </a>
                </div>
            </div>

            <ul class="box-info">
                <div class="card">
                    <div>
                        <div class="numbers">1,504</div>
                        <div class="cardName">Daily Views</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">1,504</div>
                        <div class="cardName">Daily Views</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">1,504</div>
                        <div class="cardName">Daily Views</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>
            </ul>
            <!-- l -->
            <div class="head-title">
                <div class="left">
                    <ul class="breadcrumb">
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="#">Home</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="activity">


                <table class="tableau-style">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Categorie</th>
                            <th>Prix unitaire</th>
                            <th>Quantite</th>
                            <th>Taux</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td>{{$index=$index+1}}</td>
                            <td> <img src=" @if($item->photo!='') {{url('/')}}/photoProduit/{{$item->photo}} @else {{url('/')}}/avatar.png @endif" alt="tof" style="width:100px;height:100px;border-radius:5px;background:white;" /></td>
                            <td> {{$item->nom}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{$item->nomcat}}</td>
                            <td>{{$item->prix}} FCFA</td>
                            <td>{{$item->quantite}} unite</td>
                            <td>{{$item->taux}}%</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>


            </div>

        </main>
        <script src="../js/Scriptdash.js"></script>
</body>

</html>