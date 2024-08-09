@php
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use App\Models\Photoproduit;
if(isset(Auth::user()->id))
{
if(isset($count)===false)
{
$count =Cart::where('user_id',Auth::user()->id)->count();
}
}


@endphp

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar et Cards</title>
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/Detail.css')}}">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/InscriptionVendeur.css')}}">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/TableStyle.css')}}">
    <link rel="stylesheet" href="{{asset('New_pages/fivhier_css/styledetail.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <style>
        .product-images {
            flex: 1;
        }

        .main-image img {
            width: 100%;
            display: block;
            border-radius: 8px;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .small-images {
            margin-top: 10px;
        }

        .small-img {
            width: 80px;
            margin-right: 10px;
            cursor: pointer;
            border-radius: 8px;
            transition: transform 0.2s ease;
        }

        .small-img:hover {
            transform: scale(1.1);
        }

        .bigImage {
            max-width: 300px
        }

        .main-image,
        .product-images {

            width: 100%;
            height: 100%;
        }

        h3 {
            display: flex;
            flex-direction: row;
        }

        p {
            font-weight: 100;
            margin-left: 6px;
        }

        .pann {
            font-size: 40px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 15px;
        }

        @media screen and (max-width:968px) {


            .main-image {

                height: 200px;

            }

            .theme {
                margin-bottom: 50px;
            }

            .bigImage {
                margin-left: auto;
                margin-right: 200px;
                min-height: 100%;
                height: 100%;
                max-width: 150%;
                width: 100%;

            }

            .main-image img {
                width: 100%;
                display: block;
                transition: none;
            }

            .item-info {
                line-height: 0.3;
            }

            .pann {
                font-size: 20px;
                margin-left: auto;
                margin-right: auto;
                margin-top: 25px;
            }

        }
    </style>
</head>

<body>
    <div class="container">
        @auth
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
                        <ul class="dropd" style="margin-top:20px;">
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
        @else
        <div class="sidebar" id="sidebar">
            <div class="profile">
                <img src="{{asset('New_pages/image/icon1.png')}}" alt="Photo de profil" style=" height:200px;width:200px">

            </div>

            <nav>
                <ul class="List">
                    <li>
                        <a href="#">
                            <i class="fas fa-home">
                                <span class="nav-item">Home</span>
                            </i>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="fas fa-user" style="display:flex;flex-direction:row">
                                <span class="nav-item">Compte</span>
                                <i class="fas fa-caret-down"></i>
                            </i>

                        </a>
                        <ul class="dropd" style="margin-top:20px;">
                            @if (Route::has('login'))

                            @auth


                            @php
                            $result='';
                            if(Auth::user()->usertype=='user')
                            {
                            $result='/dashboard';
                            }
                            if(Auth::user()->usertype=='admin')
                            {
                            $result='admin/dashboard';
                            }
                            if(Auth::user()->usertype=='superadmin')
                            {
                            $result='superadmin/dashboard';
                            }
                            if(Auth::user()->usertype=='seller')
                            {
                            $result='seller/dashboard';
                            $userTest=User::findOrFail(Auth::user()->id);
                            if( $userTest->forfait->statut=='Bloquer')
                            {
                            $result='/';
                            }
                            }
                            @endphp



                            <li>
                                <a href="{{ url($result) }}" style="display:flex;flex-direction:row">
                                    <i class="fas fa-home"> </i>
                                    Dashboard

                                </a>
                            </li>
                            @else
                            <li class="">
                                <a href="{{ route('login') }}" style="display:flex;flex-direction:row;min-width:200px;margin-left:-40px">
                                    <i class="fas fa-lock" style="margin-right:30px;"> </i>
                                    Se Connecter


                                </a>
                            </li>
                            @if (Route::has('register'))
                            <li class="bou">
                                <a href="{{ route('register') }}" style="display:flex;flex-direction:row;min-width:200px;margin-left:-40px">
                                    <i class="fas fa-user" style="margin-right:30px"> </i>
                                    S'incrire


                                </a>
                            </li>
                            @endif
                            @endauth

                            @endif

                        </ul>

                    </li>
                    @if (isset($result))
                    @if ($result=='/')
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
                    @endif
                    @endif

                </ul>
            </nav>
        </div>
        @endauth

        <div class="main-content">

            <div class="menu__bar">
                <div class="menu-icon" id="menu-icon" style="color: white;">&#9776;</div>
                @if (isset($count))
                <div class="pann">
                    <a href="{{url('mycart')}}"><i class=" fa fa-shopping-cart pannier" style="color:white;" aria-hidden="true"> {{$count}} </i></a>
                </div>
                @endif
            </div>


            <div class="shopping-cart">

                <h2 class="theme" style="color:black">{{$produit->user->name}}</h2>
                <a class="deselect-all" href="{{route('visiteboutique',['seller_id'=>$produit->user->id])}}" style="background-color:#FF8000;border-radius:8px;"><i class=" fa fa-home pannier" style="color:white;" aria-hidden="true"></i> Boutique</a>
                <div class="cart-item">


                    <div class="product-images">
                        <div class="main-image">
                            <img id="main-img" class="bigImage" src="{{url('/')}}/photoProduit/{{$produit->photo}}" alt="Produit {{$produit->nom }}">
                        </div>
                        <div class="small-images">
                            @foreach ($produit->photoproduits()->get() as $item)
                            <img class="small-img" src="{{url('/')}}/New_pages/AjoutPhotoProduit/photo/{{$item->imageV}}" alt="Image" style="width:60px; height:60px">
                            @endforeach
                            <img class="small-img" src="{{url('/')}}/photoProduit/{{$produit->photo }}" alt="Image" style="width:60px; height:60px">
                        </div>
                    </div>

                    <div class="item-info">
                        <div style="display:flex; flex-direction:row; margin-top:20px;">
                            <h3>Nom : <p>{{$produit->nom}}</p>
                            </h3>
                        </div>
                        <div style="display:flex; flex-direction:row; margin-top:20px;">
                            <h3>Description : <p>{{$produit->description}}</p>
                            </h3>
                        </div>
                        <div style="display:flex; flex-direction:row; margin-top:20px">
                            <h3>Taux: <p>{{$produit->taux}} %</p>
                            </h3>
                        </div>
                        <div style="display:flex; flex-direction:row; margin-top:20px" class="price">
                            <h3>Prix: <p>{{$produit->prix}} FCFA</p>
                            </h3>
                        </div>
                        <div style="margin-left:auto;width:100px;display:flex;flex-direction:row;margin-right:auto;margin-top:80px">
                            @if ($produit->user->forfait->statut!='impayer')
                            <a class="save-for-later" href="{{url('add_cart',$produit->id)}}"><i class=" fa fa-shopping-cart pannier" style="color:white;" aria-hidden="true"></i></a>
                            @endif
                            <a class="compare" href="{{url('/dashboard')}}" style="background-color:#FF8000;"><i class="fa fa-arrow-left" style="color:white;"></i> <span style="margin-left:8px;margin-top:5px">Back</span> </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>




    </div>
    </div>
    <script>
        // Sélection des éléments HTML nécessaires
        const mainImg = document.getElementById('main-img');
        const smallImgs = document.querySelectorAll('.small-img');

        // Ajout d'un gestionnaire d'événement aux images petites pour changer l'image principale
        smallImgs.forEach(img => {
            img.addEventListener('click', () => {
                mainImg.src = img.src;
                mainImg.alt = img.alt;
            });

            img.addEventListener('dblclick', () => {
                window.open(img.src, '_blank');
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('a.boutton').forEach(function(element) {
                element.addEventListener('click', function(event) {
                    event.preventDefault();
                    var url = this.href;
                    fetch(url, {
                            method: 'GET',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                toastr.success(data.message);
                            } else {
                                toastr.error(data.error);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
    <script src="{{asset('New_Pages/js/script.js')}}"></script>
</body>

</html>