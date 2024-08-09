<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/admin.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/boxicons.min.css')}}">
    <style>
        li {
            margin-left: 18px;
        }

        a i {
            margin-right: 9px;
        }
    </style>


    <title>Document</title>
</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">

        <ul class="side-menu top">


            <a href="#" class="brand">

                <div class="profile" >
                    <img src="@if(Auth::user()->photo!=''){{url('/')}}/photosUsers/{{Auth::user()->photo }} @else {{url('/')}}/avatar.png @endif" alt="Photo de profil">
                    <h4>{{Auth::user()->name}}</h4>
                </div>
            </a>


            <li style="margin-top:90px">
                <a href="{{url('superadmin/dashboard')}}" >
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
            <li>
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
            <li class="active"><a href="{{route('profile.edit')}}">
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
        
        </nav>
        <!-- NAVBAR -->

        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Profile</h1>

                </div>


            </div>



            @include('superadmin.recap')

            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>

                </div>
                @include('profile.edit')

            </div>

        </main>
        <script src="{{asset('New_Pages/js/Scriptdash.js')}}"></script>
</body>

</html>