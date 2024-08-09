@php
use App\Models\User;
$index=0;
$userTest=User::findOrFail(Auth::user()->id);
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8 ">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/Economies.css')}}">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/boxicons.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <style type="text/css">
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .page-link {
            padding: 5px 10px;
            margin: 0 5px;
            border: 1px solid #ddd;
            background-color: #FFE0D3;
            cursor: pointer;
        }

        .page-link:hover {
            background-color: #f2f2f2;
        }
    </style>
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
            <li>
                <a href="{{route('ajouterCategorieprod')}}" style="justify-content:flex-start;gap: 11px;">
                    <i class='fa fa-list-alt' style="margin-left:10px;"></i>
                    <span class="text">Categorie</span>
                </a>
            </li>
            <li class="active">
                <a href="{{route('afficheProduit')}}" style="justify-content:flex-start;gap: 11px;">
                    <i class="fa fa-book" aria-hidden="true" style="margin-left:10px;"></i>
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

            <!-- <li>
				<a href="{{route('seller.walletVendeur')}}" style="justify-content:flex-start;gap: 11px;">
					<i class='fas fa-wallet' style="margin-left:10px;"></i>
					<span class="text">Wallet</span>
				</a>
			</li> -->
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
                @if ($userTest->forfait->statut!='Bloquer'&& $userTest->forfait->statut!='impayer')
                <div class="add">
                    <a href="{{route('ajouterProduit')}}" type="submit" href="" class="btn-add text" style="border:solid 2px #FF8000;text-decoration:none;outline:none" value="">
                        <i class=" fa fa-plus" style="color:white; font-size:20px;" aria-hidden="true"></i>
                        <div class="text" style="margin-left:20px;font-weight:bold;"> Ajouter</div>
                    </a>
                </div>
                @endif


            </div>

            @include('seller.recap')
            <!-- l -->


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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="content">
                        @php
                        if(isset($query))
                        {
                        $data=$search;
                        }
                        @endphp

                        @foreach($data as $item)
                        <tr>
                            <td>{{$index=$index+1}}</td>
                            <td> <img src=" @if($item->photo!='') {{url('/')}}/photoProduit/{{$item->photo}} @else {{url('/')}}/avatar.png @endif" alt="tof" style="width:100px;height:100px;border-radius:5px;background:white;" /></td>
                            <td> {{$item->nom}}</td>
                            <td>{{$item->description}}</td>



                            @foreach($datanamecatg as $item2)

                            @if($item2->id=== $item->categorieprod_id)
                            <td>{{$item2->nom}}</td>
                            @endif

                            @endforeach

                            <td>{{$item->prix}} FCFA</td>


                            <td>{{$item->quantite}} unite</td>
                            <td>{{$item->taux}}%</td>

                            <td style="display:flex;flex-direction:row;">
                                @if ($userTest->forfait->statut!='Bloquer'&& $userTest->forfait->statut!='impayer')
                                <a href="{{route('produit.edit',$item->id)}}" class="btn" style="width:100px;margin-right:auto;margin-left:15%;margin-top:15%;">
                                    <span class="text"> <i class=" fa fa-edit" style="color:#FF8000; font-size:28px;" aria-hidden="true"></i></span>
                                </a>
                                @endif
                                <a onclick="confirmation(event)" href="{{route('produit.delete',$item->id)}}" class="btn" style="width:100px;margin-right:auto;margin-left:auto;margin-top:15%;">
                                    <span class="text"> <i class=" fa fa-trash-alt" style="color:red; font-size:28px;" aria-hidden="true"></i></span>
                                </a>

                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>


                <div class="pagination" id="pagination"></div>
            </div>

        </main>
        <script type="text/javascript">
            function confirmation(ev) {
                ev.preventDefault();
                var urlToRedirect = ev.currentTarget.getAttribute('href');
                console.log(urlToRedirect);

                swal({
                        title: "Avertissement",
                        text: "Voulez vous vraiment supprimer ce produit?",
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

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const content = document.querySelector('.content');
                const itemsPerPage = 3; // Nombre d'éléments par page
                let currentPage = 0;
                const items = Array.from(content.getElementsByTagName('tr')).slice(1);

                function showPage(page) {
                    const start = page * itemsPerPage;
                    const end = start + itemsPerPage;
                    items.forEach((item, index) => {
                        item.style.display = (index >= start && index < end) ? 'table-row' : 'none';
                    });
                }

                function createPaginationButtons() {
                    const totalPages = Math.ceil(items.length / itemsPerPage);
                    const pagination = document.getElementById('pagination');
                    pagination.innerHTML = '';

                    for (let i = 0; i < totalPages; i++) {
                        const button = document.createElement('span');
                        button.classList.add('page-link');
                        button.textContent = i + 1;
                        button.addEventListener('click', () => {
                            currentPage = i;
                            showPage(currentPage);
                        });
                        pagination.appendChild(button);
                    }
                }

                showPage(currentPage);
                createPaginationButtons();
            });
        </script>

</body>

</html>