@php
use App\Models\User;
use App\Models\Tranfert;
use App\Models\Product;
use App\Models\Economie;
use Illuminate\Support\Facades\Auth;

$TotalEco =Economie::where('statut','valide')->sum('montant');
$TotalSolde=User::all()->sum('solde');

@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/walletVendeur.css')}}">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/Economies.css')}}">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/boxicons.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <title>Document</title>
</head>
<style>
    li {
        margin-left: 18px;
    }

    a i {
        margin-right: 9px;
    }
</style>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">

            <div class="profile" style="margin-left:auto;margin-right:auto;">
                <img src="@if(Auth::user()->photo!=''){{url('/')}}/photosUsers/{{Auth::user()->photo }} @else {{url('/')}}/avatar.png @endif" alt="Photo de profil" style="margin-left: auto;margin-right:auto;border-radius:50%;" width="150" height="150">
                <h4>{{Auth::user()->name}}</h4>
            </div>

        </a>
        <ul class="side-menu top">
            <li>
                <a href="{{url('superadmin/dashboard')}}">
                    <i class='fa fa-table'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            <li class="bou">
                <a href="{{route('superadmin.admin')}}">
                    <i class="fa fa-users-cog"> </i>
                    Manager


                </a>
            </li>

            <li>
                <a href="{{route('superadmin.vendeur')}}">
                    <i class='fa fa-store'></i>
                    <span class="text">Vendeur</span>
                </a>
            </li>
            <li>
                <a href="{{route('superadmin.client')}}">
                    <i class='fa fa-users'></i>
                    <span class="text">Clients</span>
                </a>
            </li>
            <li class="active">
                <a href="{{route('superadmin.commande')}}">
                    <i class='fa fa-list'></i>
                    <span class="text">Commandes</span>
                </a>
            </li>
            <li>
                <a href="{{route('viewVerificationWallet')}}">
                    <i class='fa fa-wallet'></i>
                    <span class="text">Wallet</span>
                </a>
            </li>
            <li><a href="{{route('profile.edit')}}">
                    <i class="fas fa-cog"></i>
                    <span class="nav-item">Profile</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">

            <li>
                <a class="logout">
                    <form method="POST" action="{{ route('logout') }}" style="display: flex;flex-direction:row;align-content:center;">
                        @csrf
                        <i class='fas fa-sign-out-alt'></i>
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
        <!-- NAVBAR -->
        <nav>

            <a href="#" class="nav-link"></a>
            <a href="#" class="profile">

            </a>
        </nav>
        <!-- NAVBAR -->
        <main>
            <ul class="box-info">

                <div class="box-info " style="width:300px;height:150px;margin-left:auto;margin-right:auto">

                    <li class="card">
                        <i class="fa fa-piggy-bank" style="font-size:46px"></i>
                        <span class="text">
                            <h3 style="color:#ff8000">{{Auth::user()->solde}} FCFA</h3>
                            <p>Gain des Retraits</p>
                        </span>
                    </li>

                </div>

                <div class="box-info " style="width:300px;height:150px;margin-left:auto;margin-right:auto">

                    <li class="card">
                        <i class="fas fa-hand-holding-usd" style="font-size:46px"></i>
                        <span class="text">
                            <h3 style="color:#ff8000">{{$TotalEco*3/100}} FCFA</h3>
                            <p>Gain des Potentiels Retrait</p>
                        </span>
                    </li>

                </div>


                <div class="box-info " style="width:300px;height:150px;margin-left:auto;margin-right:auto">

                    <li class="card">
                        <i class="fas fa-wallet" style="font-size:46px"></i>
                        <span class="text">
                            <h3 style="color:#ff8000">{{$TotalEco+$TotalSolde}} FCFA</h3>
                            <p>Fond Total</p>
                        </span>
                    </li>

                </div>


            </ul>

            <div class="list">

                <a class="add" href="{{route('wallet.retraitView')}}">
                    <button class="btn-add" style="border:#FF8000 solid 2px;font-size:19px;" type="submit">Retrait</button>
                </a>
                <h2>Retraits Recents</h2>
                @php
                $tranferts=Tranfert::where('auteur_id',Auth::user()->id)->get();
                @endphp

                @foreach ($tranferts as $row)
                <div class="trans1">
                    <div class="info">
                        <p>{{$row->created_at}}</p>
                        <p>{{$row->montant}} FCFA</p>
                        <p>{{$row->type}}</p>
                    </div>
                </div>
                @endforeach



            </div>
            <div class="chart-container">
                <canvas id="myChart"></canvas>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        </main>
        <script src="../js/Scriptdash.js"></script>
</body>

</html>