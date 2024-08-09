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

    <style>
        li {
            margin-left: 18px;
        }

        a i {
            margin-right: 9px;
        }
    </style>
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
            min-width:500px;
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

        td,tr,
        th {
            flex: 1;
            height: 100%;
            align-items: center;
            align-content: center;
            text-align: center;
        }
        tr
        {
            min-width:900px;
        }

        th {
            font-size: larger;
            color: #FF8000;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">

            <div class="profile">
                <img src="@if(Auth::user()->photo!=''){{url('/')}}/photosUsers/{{Auth::user()->photo }} @else {{url('/')}}/avatar.png @endif" alt="Photo de profil">
                <h4>{{Auth::user()->name}}</h4>
            </div>
        </a>
        <ul class="side-menu top">
            <li class="active">
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
          
        </nav>
        <!-- NAVBAR -->

        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Acceuil</h1>

                </div>
                <div class="add">
                    <a href="{{url('chat')}}" class="btn-add">
                    <i class='fa fa-comments'></i>
                        <span class="text">Chat</span>
                    </a>
                </div>

            </div>

            @include('superadmin.recap')

            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Mes Enregistrements</span>
                </div>
                <div class="cont1">
                    <div class="data ID">
                        <table>
                            <theader>
                                <tr class="ligneCommande" style="height:40px;font-weight:bolder;margin-top:20px">
                                    <th><span class="data-title">ID</span></th>
                                    <th><span class="data-title">Photo</span></th>
                                    <th><span class="data-title">Nom</span></th>
                                    <th><span class="data-title">Telephone</span></th>
                                    <th><span class="data-title">Email</span></th>
                                    <th><span class="data-title">Categorie</span></th>
                                    <th><span class="data-title">Crée le</span></th>
                                </tr>
                            </theader>
                            <tbody>
                                @foreach ($data as $item)
                                <tr class="ligneCommande" @if ($color==0) style="background-color:  #F9F9F9;" @endif>
                                    <td> <span class="data-list">{{$index=$index+1}}</span></td>
                                    <td><span class="data-list"><img src="@if($item->photo!=''){{url('/')}}/photosUsers/{{$item->photo}} @else {{url('/')}}/avatar.png @endif" width="50" height="50"></span></td>
                                    <td><span class="data-list">{{$item->name}}</span></td>
                                    <td><span class="data-list">{{$item->telephone}}</span></td>
                                    <td><span class="data-list">{{$item->email}}</span></td>
                                    <td><span class="data-list">{{$item->categorie}}</span></td>
                                    <td><span class="data-list">{{$item->created_at}}</span></td>
                                </tr>

                                @php
                                if($color==0){$color=1;}else{$color=0;}
                                @endphp

                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>


        </main>
        <script src="{{asset('New_Pages/js/Scriptdash.js')}}"></script>
</body>

</html>