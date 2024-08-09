@php
use App\Models\User;
$users=User::where('usertype','user')->get();
$index=0;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8 ">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/Economies.css')}}">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/boxicons.min.css')}}">
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
    </style>
    <style>
        li {
            margin-left: 18px;
        }

        a i {
            margin-right: 9px;
        }

        tr,
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
            <div class="profile" style="margin-left: auto;margin-right:auto;">
                <img src="@if(Auth::user()->photo!=''){{url('/')}}/photosUsers/{{Auth::user()->photo }} @else {{url('/')}}/avatar.png @endif" alt="Photo de profil" style="margin-left:auto;margin-right:auto;border-radius:50%;" width="150" height="150">
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
            <li class="active">
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
            <!-- l -->
            <div class="head-title">

            </div>

            @include('superadmin.recap')
            <!-- l -->


            <div class="activity">


                <table class="tableau-style">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Nom</th>
                            <th>Telephone</th>
                            <th>Commandes</th>
                            <th>Achat Total</th>
                            <th>Epargnes</th>
                            <th>Retraits</th>
                            <th>Solde</th>
                        </tr>
                    </thead>
                    <tbody class="content">
                        @foreach ($users as $item)
                        <tr>
                            <td>{{$index=$index+1}}</td>
                            <td><img src="@if($item->photo!=''){{url('/')}}/photosUsers/{{$item->photo }} @else {{url('/')}}/avatar.png @endif" alt="Photo" width="60" height="60"></td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->telephone}}</td>
                            <td>{{$item->commandes()->count()}}</td>
                            @php
                            $totalAchat=0;
                            foreach($item->economies()->get() as $econo)
                            {
                            $totalAchat= $totalAchat+ ($econo->montant*100)/$econo->taux;
                            }
                            @endphp
                            <td>{{$totalAchat}} Fcfa</td>
                            <td>{{$item->economies()->where('statut','valide')->sum('montant')}} Fcfa</td>
                            <td>{{$item->economies()->where('statut','expired')->sum('montant')}} Fcfa</td>
                            <td>{{$item->solde}} Fcfa</td>
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