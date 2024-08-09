@php
use App\Models\User;
use App\Models\Product;
use App\Models\Commande;
$vendeur=User::findOrFail($param);
$creator=User::findOrFail($vendeur->creator_id);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('New_Pages/fivhier_css/DetailBoutique.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <title>Lumia market</title>

</head>

<body>

    <div class="bodyContaint">
        <div class="column">

            <div class="title">
                @if ($vendeur->categorie=='Bronze')
                <i class="fas fa-medal" style="color:#CD7F32;font-size:36px;margin-right:40px;"></i>
                @endif
                @if ($vendeur->categorie=='Argent')
                <i class="fas fa-medal" style="color:#C0C0C0;font-size:36px;margin-right:40px;"></i>
                @endif
                @if ($vendeur->categorie=='Or')
                <i class="fas fa-medal" style="color:#FFD700;font-size:36px;margin-right:40px;"></i>
                @endif
                @if ($vendeur->categorie=='Platine')
                <i class="fas fa-medal" style="color:#E5E4E2;font-size:36px;margin-right:40px;"></i>
                @endif
                <h4>Boutique {{$vendeur->categorie}}<br> {{$vendeur->name}} </h4>
            </div>
            @if ($vendeur->forfait->statut=='Bloquer')
            <div style="margin-left:auto ;margin-right: auto ;margin-top :15px;margin-bottom: 20px;color:red;">
                <i class="fa fa-lock"></i>
                Compte Bloqué
            </div>
            @endif

            <form method="post" action="{{route('superadmin.updateVendeur')}}">
                @csrf
                <h4>Information de la Boutique</h4>
                <input name="sellerId" type="hidden" placeholder="" value="{{$vendeur->id}}" readonly>
                <span>
                    <label>Nom</label>
                    <input type="text" placeholder="" value="{{$vendeur->name}}" readonly>
                </span>
                <span>
                    <label>Type de forfait</label>
                    <select name="categorie">
                        <option value="{{$vendeur->categorie}}">{{$vendeur->categorie}}</option>
                        <option value="Bronze">Bronze <i class="fas fa-medal" style="color:#CD7F32;font-size:16px;margin-right:40px;"></i></option>
                        <option value="Argent">Argent <i class="fas fa-medal" style="color:#C0C0C0;font-size:16px;margin-right:40px;"></i></option>
                        <option value="Or">Or <i class="fas fa-medal" style="color:#FFD700;font-size:16px;margin-right:40px;"></i></option>
                        <option value="Platine">Platine <i class="fas fa-medal" style="color:#E5E4E2;font-size:16px;margin-right:40px;"></i></option>
                    </select>
                </span>
                <span>
                    <label>Dette</label>
                    <input type="number" name="dette" placeholder="" min="0" value="{{$vendeur->forfait->dette}}" required>
                </span>
                <span>
                    <label>Statut</label>
                    <select name="statut">
                        <option value="{{$vendeur->forfait->statut}}">{{$vendeur->forfait->statut}}</option>
                        <option value="A jour">A jour</option>
                        <option value="impayer">Impayer</option>
                        <option value="Bloquer">Bloquer</option>
                    </select>
                </span>
                <input class="submit" type="submit" value="Modifier">
            </form>
        </div> 

    
        <!-- Deuxieme colone -->
        <div class="column">
            <section>
                <img class="tof" src="{{url('/')}}/photosUsers/{{$vendeur->photo }}">
                <h3 class="tofH3">
                    Forfait 1000fcfa/mois <br>
                    {{$vendeur->telephone}}<br>
                    {{$vendeur->email}}<br><br><br><br>
                    Creer par {{$creator->name}},Tel: {{$creator->telephone}}<br>
                    Email:  {{$creator->email}}<br>
                    Le :{{$vendeur->created_at}}
                </h3>
            </section>
            <div class="recaps">
                <div class="recap">
                    <h4>{{$vendeur->products()->count()}}</h4> <br>
                    Produits
                </div>
                <div class="recap">
                    <h4>{{$vendeur->solde}} Fcfa</h4> <br>
                    solde
                </div>
                <div class="recap">
                    <h4>{{$vendeur->tranfert()->count()}}</h4> <br>
                    Retraits
                </div>
                <div class="recap">
                    <h4>{{$vendeur->tranfert()->sum('montant')}} Fcfa</h4> <br>
                    Retirer
                </div>
            </div>
        </div>
    </div>


</body>

</html>