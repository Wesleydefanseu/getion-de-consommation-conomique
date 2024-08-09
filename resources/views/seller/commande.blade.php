@php
use App\Models\User;
use App\Models\Product;
use App\Models\Economie;
use App\Models\Commande_Product;
use App\Models\Commande;
use Illuminate\Support\Facades\Auth;
$index=0;
$listeCommande=array();
$donne=Commande_Product::whereHas('product',
function($query){
$query->where('seller_id',Auth::user()->id);
})->orderBy('created_at','desc')->get();

@endphp

@php
foreach($donne as $count)
{

if(in_array($count->commande_id,$listeCommande)===false)
{
array_push($listeCommande,$count->commande_id);
}
}

@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8 ">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/Economies.css')}}">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/boxicons.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <style type="text/css">
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .page-link {
            padding: 5px 10px;
            margin: 0 5px;
            border: 1px solid #ddd;
            background-color: #FFE0D3;
            cursor: pointer;
        }

        .page-link:hover {
            background-color: #f2f2f2;
        }

        td {
            text-align: center;
        }
    </style>
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
            <li class="active">
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
          
        </nav>
        <!-- NAVBAR -->

        <main>
            <!-- l -->
            <div class="head-title">
                <div class="left">


                </div>
                <div class="add">
                    <a href="{{route('ajouterProduit')}}" class="btn-add">
                    <i class="fas fa-plus"></i>
                        <span class="text" style="margin-left:10px">Ajouter</span>
                    </a>
                </div>
            </div>

            <h2 style="color:#FF8000">Liste de Commandes</h2>
            @include('seller.recap')
            <!-- l -->


            <div class="activity">

                <table class="tableau-style">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Client</th>
                            <th>Telephone</th>
                            <th>Quantite produit</th>
                            <th>Depence</th>
                            <th>Epargne</th>
                            <th>Facture</th>
                        </tr>
                    </thead>
                    <tbody class="content">
                        @foreach ($listeCommande as $item)
                        @php
                        $commande=Commande::findOrFail((int)$item);

                        if(isset($query))
                        {
                        if(in_array($commande->user_id,$search)===false)
                        {
                        continue;
                        }
                        }

                        $client=User::findOrFail($commande->user_id);

                        $lesEconomie=Economie::whereHas('commande',
                        function($query)use($commande){
                        $query->where('commande_id', $commande->id);
                        })->get();

                        $prixTotal=0;

                        foreach( $lesEconomie as $economie)
                        {
                        if ($economie->product->seller_id==Auth::user()->id){
                        $prixTotal += $economie->product->prix*$economie->quantite;
                        }


                        }



                        @endphp

                        <tr>
                            <td>{{$index=$index+1}}</td>
                            <td>{{$commande->created_at}}</td>
                            <td>{{$client->name}}</td>
                            <td>{{$client->telephone}}</td>

                            @php
                            $t=0;
                            foreach(Economie::where('commande_id',$commande->id)->get() as $p)
                            {
                            $pt=Product::findOrFail($p->product_id);
                            if($pt->seller_id==Auth::user()->id)
                            {
                            $t= $t+1;
                            }

                            }

                            @endphp


                            <td>{{$t}}</td>

                            <td>{{$prixTotal}} Fcfa</td>
                            <td>{{$commande->economies()->sum('montant')}} Fcfa</td>
                            <td>
                                <a href="{{route('seller.factureClient',$commande->id)}}"> <i class='fa fa-print' style="font-size:24px"></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>


                <div class="pagination" id="pagination"></div>
            </div>

        </main>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const content = document.querySelector('.content');
                const itemsPerPage = 3; // Nombre d'éléments par page
                let currentPage = 0;
                const items = Array.from(content.getElementsByTagName('tr')).slice(1);

                function showPage(page) {
                    const start = page * itemsPerPage;
                    const end = start + itemsPerPage;
                    items.forEach((item, index) => {
                        item.style.display = (index >= start && index < end) ? 'table-row' : 'none';
                    });
                }

                function createPaginationButtons() {
                    const totalPages = Math.ceil(items.length / itemsPerPage);
                    const pagination = document.getElementById('pagination');
                    pagination.innerHTML = '';

                    for (let i = 0; i < totalPages; i++) {
                        const button = document.createElement('span');
                        button.classList.add('page-link');
                        button.textContent = i + 1;
                        button.addEventListener('click', () => {
                            currentPage = i;
                            showPage(currentPage);
                        });
                        pagination.appendChild(button);
                    }
                }

                showPage(currentPage);
                createPaginationButtons();
            });
        </script>

</body>

</html>