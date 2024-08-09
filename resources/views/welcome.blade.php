<!DOCTYPE html>
<html lang="fr">
@php
use App\Models\User;
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar et Cards</title>
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/boutique2.css')}}">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/InscriptionVendeur.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/dur.css')}}">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


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
            <div class="profile" style="margin-left:auto ;margin-right:auto">
                <img src="{{asset('New_pages/image/icon1.png')}}" alt="Photo de profil"  style=" height:200px;width:200px">

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
                                <a href="{{ route('login') }}" style="display:flex;flex-direction:row;min-width:200px;margin-left:-100px">
                                    <i class="fas fa-lock" style="margin-right:30px"> </i>
                                    Se Connecter


                                </a>
                            </li>
                            @if (Route::has('register'))
                            <li class="bou">
                                <a href="{{ route('register') }}" style="display:flex;flex-direction:row;min-width:200px;margin-left:-100px">
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
        <div class="main-content">
            <div class="menu__bar">
                <div class="menu-icon" id="menu-icon" style="color: white;">&#9776;</div>
                <div class="panier">
                    <a href="{{url('mycart')}}"><i class=" fa fa-shopping-cart pannier" style="color:white;" aria-hidden="true"></i></a>
                </div>
            </div>
         
            <div id="search-results">

                @if(isset($sellers))
                @include('resultats.resultat',['products' => $products,'sellers' => $sellers])
                @else
                @include('resultats.resultat')
                @endif

            </div>
        </div>
    </div>
    <script src="{{asset('New_Pages/js/script.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#query').on('keyup', function() {
                var query = $(this).val();
                $.ajax({
                    url: "{{ route('search.dashboard') }}",
                    type: 'GET',
                    data: {
                        query: query
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