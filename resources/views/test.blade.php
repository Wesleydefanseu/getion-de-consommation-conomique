<!DOCTYPE html>
<html lang="fr">
@php
use App\Models\User;
use App\Models\Product;
use App\Models\PhotoUser;
use App\Models\categorieProduit;
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar et Cards</title>
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/dur.css')}}">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/dur1.css')}}">
    <!-- Ajax -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <style>
        .imageCard {
            width: 100%;
        }

        .card {
            width: 100%;
            border-radius: 12px;
            margin-left: auto;
            margin-right: auto;
        }

        .block1 {
            margin-left: 10px;
            height: 60px;
            display: flex;
            justify-content: flex-start;
            flex-direction: row;
            width: 100%;
            margin-top: 5px;
        }

        .block2 {
            height: 1000px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 5%;
            justify-content: space-around;
            width: 100%;
            margin-top: 50px;
        }

        .input-box input,
        select,
        option {
            width: 100%;
            height: 50px;
            background: transparent;
            border: none;
            outline: none;
            font-size: 1em;
            color: #FFF;
            padding: 0 35px 0 5px;
            transition: .5s ease;

        }

        .form {
            margin-top: 5px;
            display: flex;
            flex-direction: column-reverse;
            border-bottom: #FFF 2px solid;
        }

        .lablllu {
            color: white;
        }

        .menu-item {
            position: relative;
            padding: 10px 20px;
            color: white;
            cursor: pointer;
            background-color: #444;
        }

        .menu-item:hover {
            background-color: #444;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            margin-top: -0.5px;
            left: 0;

            background-color: #444;
            min-width: 150px;
            z-index: 1;
        }

        .dropdown-menu .dropdown-item {
            padding: 10px 20px;
            color: white;
            cursor: pointer;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #555;
        }

        .menu-item.dropdown:hover .dropdown-menu {
            display: block;
        }

        li,
        ul {
            list-style: none;
        }

        a {
            text-decoration: none;
        }

        @media screen and (max-width: 968px) {

            img {
                width: 100px;
            }

            .block1 {

                gap: 20px;
                flex-direction: column;
                height: auto;
            }

            .block2 {
                grid-template-columns: 1fr;
                gap: 50px;
                margin-left: auto;
                margin-right: auto;
            }

            .card {
                margin-left: auto;
                margin-right: auto;
                width: 300px;
                margin-top: 12%;
            }

            .imageCard {
                width: 100%;
            }

            .tele {
                margin-left: -30px;
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
                    <li style="margin-top:-57px"><a href="{{url('/dashboard')}}">
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
                        <ul class="dropd" style="margin-top:20px;margin-left:-17px">
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

                            <form method="POST" action="{{ route('logout') }}" style="display: flex;flex-direction:row;align-content:center;margin-top: -30px;">
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
            <section class="main swiper mySwiper">



                <!-- recherche -->
            

                <!--  -->

                <div class="menu-icon" id="menu-icon" style="color: white;">&#9776;</div>
                <!-- The sidebar -->
                @php
                $data = User::findOrFail($seller_id);
                @endphp




                <div class="wrapper swiper-wrapper">

                    @php

                    $tof=PhotoUser::where('seller_id',$seller_id)->get();
                    $index=1;
                    @endphp

                    <div class="slider swiper-slide ">
                        <img src="{{url('/')}}/photosUsers/{{$data->photo}}" class="image" alt="">
                        <div class="image-data">

                            <h2 class="reduise">{{$data->name}} <br>
                                <!-- Boutique {{$data->categorie}} -->
                            </h2>

                            <div style="display:flex;flex-direction:row;margin-left:auto;margin-right:auto;justify-content:center;gap: 15px;align-content:center">
                                <h3 onclick="contactW('{{$data->telephone}}')"><img src="{{asset('New_Pages/image/WhatsApp.svg')}}" alt="" width="40px" height="40px"></h3>
                                <h3 onclick="contactT('{{$data->telephone}}')"><img class="tele" src="{{asset('New_Pages/image/telegram.png')}}" alt="" width="40px" height="40px" style="border-radius: 50%;max-width: 40px;"></h3>

                                <h3 onclick=" contactM('{{$data->email}}')"><i class="fa fa-envelope" style="font-size: 36px;margin-bottom:35px;color:white" aria-hidden="true"></i></h3>
                                <!-- <a href="{{url('chat/vendeur',$data->id)}}">
                                    <h3><i class="fa fa-comments" style="font-size: 36px;margin-bottom:35px;color:white" aria-hidden="true"></i></h3>
                                </a> -->
                            </div>

                        </div>
                    </div>
                    @foreach ( $tof as $apecu )
                    <div class="slider swiper-slide ">
                        <img src="{{url('/')}}/New_pages/AjoutPhotoVendeur/photo/{{$apecu->imageV}}" class="image" alt="">
                        @if ($index==1)
                        <div class="image-data">
                            <span class="text">

                                Contact : {{$data->telephone}}

                            </span>
                            <h2 class="reduise">mail : {{$data->email}} <br>
                            </h2>
                            @php
                            $index++;
                            @endphp
                        </div>
                        @endif
                    </div>
                    @endforeach




                </div>

                <div class="swiper-button-next nav-btn"></div>
                <div class="swiper-button-prev nav-btn"></div>
                <div class="swiper-pagination"></div>
            </section>

            <!-- Swiper JS -->
            <script src="{{asset('New_Pages/js/swiper-bundle.min.js')}}"></script>

            <!-- Initialize Swiper -->
            <script>
                var swiper = new Swiper(".mySwiper", {
                    slidesPerView: 1,
                    spaceBetween: 30,
                    loop: true,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                });
            </script>
            <div class="block">
                @php

                $data = CategorieProduit::where('seller_id', $seller_id)->orderBy('nom', 'asc')->get();
                @endphp


                <li class="menu-item dropdown">
                    <i class="fa fa-list-alt" style="color:white"></i>
                    Categorie
                    <ul class="dropdown-menu">
                        @foreach ($data as $row)
                        <a href="{{route('boutique.categorie.speciale',$row->id)}}">
                            <li class="dropdown-item">
                                {{$row->nom}}
                            </li>
                        </a>
                        @endforeach
                    </ul>
                </li>

            </div>

            @php
            if(isset($Produitboutique)==false)
            {
            $Produitboutique = Product::where('seller_id', $seller_id)->orderBy('nom', 'asc')->get();
            }
            @endphp

            <div id="search-results" class="block2" style="gap:20px;">
                @if(isset($products)&& isset($Produitboutique)==true)
                @include('resultats.resultat2',['products' => $products,'Produitboutique' => $Produitboutique])
                @else
                @include('resultats.resultat2',['Produitboutique' => $Produitboutique])
                @endif

            </div>

        </div>
    </div>
    <!-- slide -->
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
    <!--  -->

    <script>
        $(document).ready(function() {
            $('#query').on('keyup', function() {
                var query = $(this).val();
                var seller_id = $('#seller_id').val(); // Assure-toi d'avoir un champ caché ou un moyen de récupérer le seller_id

                $.ajax({
                    url: "{{ route('search.test') }}",
                    type: 'GET',
                    data: {
                        query: query,
                        idSeller: seller_id
                    },
                    success: function(data) {
                        $('#search-results').html(data);
                    }
                });
            });
        });
    </script>
    <!--  -->

    <script>
        function contactW(phone) {
            var phoneNumber = '682014290'; // Remplacez par le numéro de téléphone souhaité
            var whatsappURL = 'https://wa.me/+237' + phone + '';
            window.open(whatsappURL, '_blank');
        };

        function contactT(phone) {
            var telegramUsername = 'Ndokguouo Mureille'; // Remplacez par le nom d'utilisateur Telegram souhaité
            var telegramURL = 'https://t.me/+237' + phone + '';
            window.open(telegramURL, '_blank');
        };

        function contactM(email) {
            // Remplacez par l'adresse email souhaitée
            var subject = 'Lumia Macket'; // Remplacez par l'objet souhaité
            var body = 'Bonjour'; // Remplacez par le texte du corps souhaité
            var mailtoURL = 'mailto:' + email + '?subject=' + encodeURIComponent(subject) + '&body=' + encodeURIComponent(body);
            window.open(mailtoURL, '_self');
        };
    </script>
    <script src="{{asset('New_Pages/js/script.js')}}"></script>


</body>

</html>