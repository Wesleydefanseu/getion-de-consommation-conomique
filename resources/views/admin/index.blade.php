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
            width: 130%;
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
        tr,
        th {
            flex: 1;

            height: 100%;
            align-items: center;
            align-content: center;
            text-align: center;
        }

        tr {
            min-width: 900px;
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
        <a href="#" class="brand" style="height:200px;margin-top:-10px;">

            <div class="profile">
                <img src="@if(Auth::user()->photo!=''){{url('/')}}/photosUsers/{{Auth::user()->photo }} @else {{url('/')}}/avatar.png @endif" alt="Photo de profil">
                <h4>{{Auth::user()->name}}</h4>
            </div>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="{{route('admin.index')}}" style="justify-content:flex-start;gap: 11px;">
                    <i class='fa fa-users' style="margin-left:10px;"></i>
                    <span class="text">Vendeur</span>
                </a>
            </li>
            <li><a href="{{route('contact')}}" style="justify-content:flex-start;gap: 11px;">
                    <i class='fa fa-phone' style="margin-left:10px;"></i>
                    <span class="nav-item">Contactez -nous</span>
                </a>
            </li>

            <li><a href="{{route('admin.profile')}}" style="justify-content:flex-start;gap: 11px;">
                    <i class='fa fa-user' style="margin-left:10px;"></i>
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
        <!-- NAVBAR -->
        <nav>
           
        </nav>
        <!-- NAVBAR -->

        <main>


            <div class="add">
                <a href="{{route('ajouteVueVendeur')}}" class="btn-add">
                    <i class=" fa fa-plus" style="color:white; font-size:20px;" aria-hidden="true"></i>
                    <div class="text" style="margin-left:20px;font-weight:bold;"> Ajouter</div>
                </a>
            </div>

            <div class="box-info " style="width:300px;height:150px;margin-left:auto;margin-right:auto">

                <li class="card">
                    <i class="fa fa-users" style="font-size:46px"></i>
                    <span class="text">
                        <h3>{{$count}}</h3>
                        <p>Total Vendeur</p>
                    </span>
                </li>

            </div>



            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Vendeurs Enregistrés</span>
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
                                @php
                                if(isset($query))
                                {
                                $data=$search;
                                }
                                @endphp
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