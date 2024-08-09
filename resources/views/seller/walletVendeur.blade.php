@php
use App\Models\User;
use App\Models\Tranfert;
use App\Models\Product;
use App\Models\Economie;
use Illuminate\Support\Facades\Auth;

$data1 =Economie::all();
$totalProduit = Product::where('seller_id', Auth::user()->id)->count();
$totalEconomie=0;
$RetraitGagner=0;
$listClient_id=array(-1,0);
foreach($data1 as $item )
{
$pdt=Product::findOrFail($item->product_id);
if($pdt->seller_id==Auth::user()->id)
{
if($item ->statut=='valide')
{
$totalEconomie=$totalEconomie+$item ->montant;
}

if($item ->statut=='expired')
{
    $RetraitGagner=$RetraitGagner + $item ->montant*2/100;
}

}


if(Auth::user()->id===$pdt->seller_id)
{
if(in_array($item->user_id,$listClient_id))
{
}
else
{
array_push($listClient_id,$item->user_id);
}
}
}
$totalclient=count($listClient_id)-2;
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

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <!-- <i class='bx bxs-smile'></i>
			<span class="text">Levegi</span> -->
            <div class="photo-container">
                <img id="photo-preview" src="@if(Auth::user()->photo!=''){{url('/')}}/photosUsers/{{Auth::user()->photo }} @else {{url('/')}}/avatar.png @endif" alt="Photo de profil">
            </div>
        </a>

        <ul class="side-menu top">
            <h2 style="text-align:center;color:#FF8000">{{Auth::user()->name}}</h2>
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
            <li>
                <a href="{{route('affichecommande')}}" style="justify-content:flex-start;gap: 11px;">
                    <i class='fa fa-credit-card' style="margin-left:10px;"></i>
                    <span class="text">Commandes</span>
                </a>
            </li>

            <li class="active">
                <a href="{{route('seller.walletVendeur')}}" style="justify-content:flex-start;gap: 11px;">
                    <i class='fas fa-wallet' style="margin-left:10px;"></i>
                    <span class="text">Wallet</span>
                </a>
            </li>
            <li><a href="{{route('profile.edit')}}" style="justify-content:flex-start;gap: 11px;">
                    <i class="fa fa-user" style="margin-left:10px;"></i>
                    <span class="nav-item">Profile</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">

            <li>
                <a class="logout">
                    <form method="POST" action="{{ route('logout') }}" style="display: flex;flex-direction:row;align-content:center;">
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
                            <p>Total Vente</p>
                        </span>
                    </li>

                </div>

                <div class="box-info " style="width:300px;height:150px;margin-left:auto;margin-right:auto">

                    <li class="card">
                        <i class="fas fa-hand-holding-usd" style="font-size:46px"></i>
                        <span class="text">
                            <h3 style="color:#ff8000">{{$totalEconomie*2/100}} FCFA</h3>
                            <p>Gain des Potentiels Retrait</p>
                        </span>
                    </li>

                </div>


                <div class="box-info " style="width:300px;height:150px;margin-left:auto;margin-right:auto">

                    <li class="card">
                        <i class="fas fa-wallet" style="font-size:46px"></i>
                        <span class="text">
                            <h3 style="color:#ff8000">{{$RetraitGagner}} FCFA</h3>
                            <p>Gain des Retraits</p>
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