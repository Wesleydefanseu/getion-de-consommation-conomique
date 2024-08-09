@php

use App\Models\Cart;
use App\Models\User;

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

    /* Extra large devices (large desktops, 1200px and up) */
    @media (max-width: 1450px) {
        .block2 {
            grid-template-columns: repeat(3, 1fr);
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
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .pannier {
            font-size: 25px;
            margin-left: auto;
            margin-right: auto;
        }

        .recherche {
            width: 200px;
            margin-left: 68%;
            margin-top: -3%;
        }
    }

    /* Medium devices (tablets, 768px and up) */
    @media (max-width: 778px) {
        .block2 {
            grid-template-columns: repeat(1, 1fr);
            gap: 10px;
        }

        .pannier {
            font-size: 28px;
            margin-left: auto;
            margin-right: auto;
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

        .pannier {
            display: none;
            margin-right: auto;
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
                    <li><a href="{{route('viewVerificationWallet')}}">
                            <i class="fas fa-wallet"></i>
                            <span class="nav-item">Wallet</span>
                        </a></li>
                    <li><a href="{{route('contact')}}">
                            <i class='fa fa-phone' style="margin-left: 15px;"></i>
                            <span class="nav-item">Contact </span>
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
        <div class="main-content">
            <div class="menu__bar">
                <div class="menu-icon" id="menu-icon" style="color: white;">&#9776;</div>
                <div style="font-size: 40px;margin-left:50%;margin-top:15px;">
                    <a href="{{url('mycart')}}"><i class=" fa fa-shopping-cart pannier" style="color:white;" aria-hidden="true"> {{$count}} </i></a>
                </div>
            </div>
            <form action="{{route('search.boutiqueC')}}" method="POST">
            @csrf
                <div class="recherche">
                    <!-- <input class="research" type="search" placeholder="Effectuer une recherche..."> -->

                    <div class="recherche">
                        <div class="input-box" style="margin-top:-25%">
                            <input type="hidden" id="categorietype" name="categorietype" value="{{$categorie}}">
                            <input type="tel" style="color:orange;" id="query" name="rechearch" placeholder="Recherche" @if (isset($rechearch))
                            value="{{$rechearch}}"
                            @endif required>
                            <input type="submit" style="display:none">
                        </div>
                    </div>

                </div>
            </form>
            <div class="cards" id="search-results">

                <!-- 
                @if($data!=null)
                @foreach ($data as $item)
                <a href="{{route('visiteboutique',['seller_id'=>$item->id])}}">
                    <div class="card">
                        <img src="{{url('/')}}/photosUsers/{{$item->photo}}" alt="" width="320px;" height="200px;" style="background-size: cover;">
                        <div class="card-content">
                            <h3 style="color:#FF8000">{{$item->name}}</h3>
                            <p style="color:#FF8000">Categorie: {{$item->categorie}}</p>
                            <div class="icon">

                                @if ($item->categorie=='Bronze')
                                <i class="fas fa-medal" style="color:#CD7F32;font-size:36px;margin-right:40px;"></i>
                                @endif
                                @if ($item->categorie=='Argent')
                                <i class="fas fa-medal" style="color:#C0C0C0;font-size:36px;margin-right:40px;"></i>
                                @endif
                                @if ($item->categorie=='Or')
                                <i class="fas fa-medal" style="color:#FFD700;font-size:36px;margin-right:40px;"></i>
                                @endif
                                @if ($item->categorie=='Platine')
                                <i class="fas fa-medal" style="color:#E5E4E2;font-size:36px;margin-right:40px;"></i>
                                @endif

                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
                @endif -->
                @include('resultats.resultaBoutiqueC',['data' => $data])

            </div>

        </div>
        <div class="container2" style="height: 600px;">

        </div>
    </div>

    <script src="{{asset('New_Pages/js/script.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#query').on('keyup', function() {
                var rechearch = $(this).val();
                var categorietype = $('#categorietype').val(); // Assure-toi d'avoir un champ caché ou un moyen de récupérer le seller_id

                $.ajax({
                    url: "{{ route('search.boutiqueC') }}",
                    type: 'POST',
                    data: {
                        rechearch: rechearch,
                        categorietype: categorietype
                    },
                    success: function(data) {
                        $('#search-results').html(data);
                    }
                });
            });
        });
    </script>
</body>

</html>