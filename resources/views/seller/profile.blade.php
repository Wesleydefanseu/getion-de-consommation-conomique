@php
use App\Models\User;
use Illuminate\Support\Facades\Auth;
$color=0;
$index=0;
$count =User::where('creator_id',Auth::user()->id)->count();
$data=User::where('creator_id',Auth::user()->id)->get();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/admin.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/boxicons.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
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
            height: 60px;
            border-radius: 9px;
            align-items: center;
            margin-top: 18px;
        }

        table {
            margin-left: 15px;

        }

        img {
            border-radius: 50%;
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

        th {
            font-size: larger;
            color: #FF8000
        }
    </style>
    <title>Document</title>
</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">

            <div class="profile" style="height:200px;margin-top:-80px;">
                <img src="@if(Auth::user()->photo!=''){{url('/')}}/photosUsers/{{Auth::user()->photo }} @else {{url('/')}}/avatar.png @endif" alt="Photo de profil">
                <h4>{{Auth::user()->name}}</h4>
            </div>
        </a>
        <ul class="side-menu top">
            
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
            <li >
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
            <li class="active"><a href="{{route('profile.edit')}}" style="justify-content:flex-start;gap: 11px;">
                    <i class="fa fa-user" style="margin-left:10px;"></i>
                    <span class="nav-item">Profile</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">

            <li>
                <a class="logout">
                    <form method="POST" action="{{ route('logout') }}" style="display: flex;flex-direction:row;justify-content:flex-start;gap: 11px;">
                        @csrf
                        <i class="fas fa-sign-out-alt" style="margin-left:10px;"></i>
                        <div :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            <span class="text"> {{ __('Log Out') }}</span>

                        </div>
                    </form>
                </a>

            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->


    <!-- CONTENT -->
    <section id="content">
      

        <main>
            @include('profile.edit')
        </main>
        <script src="{{asset('New_Pages/js/Scriptdash.js')}}"></script>

</body>

</html>