<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
@php
use App\Models\User;
$Tuser=User::where('usertype','user')->count();
$Tadmin=User::where('usertype','admin')->count();
$Tvendeur=User::where('usertype','seller')->count();

@endphp

<ul class="box-info" style="text-align:center">

    <div class="box-info " style="width:300px;height:150px;margin-left:auto;margin-right:auto">

        <li class="card">
            <i class="fa fa-users" style="font-size:46px"></i>
            <span class="text">
                <h3 style="color:#ff8000">{{$Tuser}}</h3>
                <p>Total Clients</p>
            </span>
        </li>

    </div>

    <div class="box-info " style="width:300px;height:150px;margin-left:auto;margin-right:auto">

        <li class="card">
            <i class="fa fa-store" style="font-size:46px"></i>
            <span class="text">
                <h3 style="color:#ff8000">{{$Tvendeur}}</h3>
                <p>Total Vendeurs</p>
            </span>
        </li>

    </div>

    <div class="box-info " style="width:300px;height:150px;margin-left:auto;margin-right:auto">

        <li class="card">
            <i class="fa fa-users-cog" aria-hidden="true" style="font-size:46px"></i>
            <span class="text">
                <h3 style="color:#ff8000">{{$Tadmin}}</h3>
                <p>Total Manager</p>
            </span>
        </li>

    </div>

</ul>