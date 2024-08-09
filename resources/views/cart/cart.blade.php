@php
use App\Models\Product;
use App\Models\Cart;

if(isset($count)===false)
{
$count =Cart::where('user_id',Auth::user()->id)->count();
}

@endphp
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar et Cards</title>
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/boutique2.2.css')}}">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/InscriptionVendeur.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/Cart.css')}}">

    <style type="text/css">
        .pagination {
            display: flex;
            justify-content: center;

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
        .pan
        {
            font-size: 40px;margin-left:50%;margin-top:15px;
        }
      
     @media screen and (max-width: 568px) 
     {
        .pan
        {
            font-size: 30px;margin-right:auto;margin-top:15px;margin-left: auto;
        }

        .hidden
        {
            display :none;
        }
        .main-content
        {
            display: inline-block;
            flex-direction: column;
        }
        .menu__bar
        {
            flex: 1;
            width: 100%;
        }
        table,tr
        {
            min-width: 100%;
           
        }
        .cart_value
        {
            margin-left: auto;
            margin-right: auto;
        }
       
     }

    </style>
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/dur.css')}}">
</head>


<body>
    <div class="container">
        <div class="sidebar" id="sidebar">
            <div class="profile">
                <!-- <img src="{{asset('New_Pages/image/pexels-photo-2034541.png')}}" alt="Photo de profil"> -->
                <img src="@if(Auth::user()->photo!=''){{url('/')}}/photosUsers/{{Auth::user()->photo }} @else {{url('/')}}/avatar.png @endif" alt="Photo de profil">
                <h2>{{Auth::user()->name}}</h2>
            </div>

            <nav>
                <ul>
                    <li><a href="{{url('/dashboard')}}">
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
                        <ul class="dropd" style="margin-top:20px;margin-left:-15px;">
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
                </ul>
            </nav>
        </div>


        <div class="main-content">
            <div class="menu__bar">
                <div class="menu-icon" id="menu-icon" style="color: white;">&#9776;</div>
                <div class="pan">
                    <a href="{{url('mycart')}}"><i class=" fa fa-shopping-cart pannier" style="color:white;" aria-hidden="true"> {{$count}} </i></a>
                </div>
            </div>
          
            <div class="carttable" >
                
                <table class="tableau-style">
                    <thead >
                        <tr>

                            <th>Nom</th>
                            <th>Prix</th>
                            <th  class="hidden">Taux</th>
                            <th class="hidden">Photo</th>
                            <th style="width:100px;">Quantite</th>
                            <th>Epargne</th>
                            <th>Retirer</th>
                            @php
                            $value=0;
                            $quant=0;
                            $epargT=0;
                            @endphp
                        </tr>
                    </thead>
                    <tbody class="content">
                        @foreach($cart as $item)
                        <tr>
                            @php
                            $produit= Product::findOrFail($item->product_id);
                            $ptInter=0;
                            @endphp

                            <td>{{$produit->nom}}</td>
                            <td>{{ $ptInter= $produit->prix*$item->quantite}}FCFA</td>
                            <td  class="hidden">{{$produit->taux}}%</td>
                            <td class="hidden"> <img src="/photoProduit/{{$produit->photo}}" width="150" height="150" /></td>
                            <td  style="display:flex;flex-direction:row;justify-content:center">
                                <a href="{{url('update_qty_desc',$item->id)}}" class="btn-add" style="width:100px;margin-right: auto;margin-left:auto;margin-top:35%;">
                                    <i class=" fa fa-minus " style="color:black; font-size:24px;" aria-hidden="true"></i>
                                </a>
                                <label style="font-size:24px;margin-right:auto;margin-left:auto;margin-top:35%;">{{$item->quantite}}</label>
                                <a href="{{url('update_qty_inc',$item->id)}}" class="btn-add" style="width:100px;margin-right:auto;margin-left:auto;margin-top:35%;">
                                    <i class=" fa fa-plus" style="color:black;font-size:24px;" aria-hidden="true"> </i>
                                </a>

                            </td>
                            <td>{{ ($ptInter*$produit->taux)/100 }}FCFA</td>
                            <td><a href="{{url('delete_cart',$item->id)}}">
                                    <i class=" fa fa-trash-alt" style="color:red; font-size:28px;" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        @php
                        $value=$value+ ($produit->prix*$item->quantite);
                        $quant= $quant+$item->quantite;
                        $epargT= $epargT+ ($ptInter*$produit->taux)/100 ;
                        @endphp

                        @endforeach

                    </tbody>
                </table>
                <div class="pagination" id="pagination"></div>
                <div class="cart_value">
                    <table style="background: #f1ebe9;width:400px;">

                        <tbody>
                            <tr>
                                <th colspan="2">Total Panier</th>
                            </tr>
                            <tr style="background: #f1ebe9;">
                                <th style="text-align: left;">Total Prix</th>
                                <th style="text-align: right;">{{$value}} FCFA</th>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Quantite Total</th>
                                <th style="text-align: right;"> {{ $quant}}</th>
                            </tr>
                            <tr style="background: #f1ebe9;">
                                <th style="text-align: left;">Epargne Total</th>
                                <th style="text-align: right;"> {{$epargT}} FCFA</th>
                            </tr>

                            @if ($count>=1)

                            <tr style="background: #f1ebe9;">
                                <form method='POST' action="{{url('Client/ValidationCommande')}}">
                                    @csrf
                                    <th colspan="2">
                                        <input type="hidden" name="quantite" value="{{$quant}}">
                                        <input type="hidden" name="epargne" value="{{$epargT}}">
                                        <input type="hidden" name="prixtotal" value="{{$value}} ">

                                        <button type="submit" style="background: #FF8000;width:200px ;font-weight:bold;color:white;">
                                            <i class="fa fa-credit-card" style="font-size: 24px;margin-right:8px;" aria-hidden="true"></i>
                                            Effectuer Achat
                                        </button>

                                    </th>
                                </form>

                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div style="width:300px;height:100px">

                </div>
            </div>

        </div>
    </div>




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
    <script src="{{asset('New_Pages/js/script.js')}}"></script>
</body>

</html>