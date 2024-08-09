@php
use App\Models\Product;
use App\Models\User;
@endphp



<div class="cards">

    @if (isset($sellers))

    @foreach ($sellers as $bts)


    <a href="{{route('visiteboutique',['seller_id'=>$bts->id])}}">
        <div class="card">
            <img src="{{url('/')}}/photosUsers/{{$bts->photo}}" alt="" width="320px;" height="200px;" style="background-size: cover;">
            <div class="card-content">
                <h3 style="color:#FF8000">{{$bts->name}}</h3>
                <p style="color:#FF8000">Categorie: {{$bts->categorie}}</p>
                <div class="icon">

                    @php
                    $color='white';
                    if($bts->categorie=='Bronze')
                    {
                    $color='style="color:#CD7F32;font-size:36px;" ';
                    }
                    if($bts->categorie=='Argent')
                    {
                    $color='style="color:#C0C0C0;font-size:36px;" ';
                    }
                    if($bts->categorie=='Or')
                    {
                    $color='style="color:#FFD700;font-size:36px;" ';
                    }
                    if($bts->categorie=='Platine')
                    {
                    $color='style="color:#E5E4E2;font-size:36px;" ';
                    }
                    @endphp

                    <i class="fas fa-medal"
                     @php echo $color;
                     @endphp
                    ></i>
                </div>
            </div>
        </div>
    </a>
    @endforeach

    @else
    <!-- -->
    @php


    $bronze = User::where('categorie', '=', 'Bronze')
    ->where('usertype', '=', 'seller')
    ->latest()
    ->first();
    $argent = User::where('categorie', '=', 'Argent')
    ->where('usertype', '=', 'seller')->latest()
    ->latest()
    ->first();
    $or = User::where('categorie', '=', 'Or')
    ->where('usertype', '=', 'seller')->latest()
    ->latest()
    ->first();
    $platinium = User::where('categorie', '=', 'Platine')
    ->where('usertype', '=', 'seller')->latest()
    ->latest()
    ->first();

    @endphp

    @if($bronze!=null)
    <a href="{{route('visiteboutique',['seller_id'=>$bronze->id])}}">
        <div class="card">
            <img src="{{url('/')}}/photosUsers/{{$bronze->photo}}" alt="" width="320px;" height="200px;" style="background-size: cover;">
            <div class="card-content">
                <h3 style="color:#FF8000">{{$bronze->name}}</h3>
                <p style="color:#FF8000">Categorie: {{$bronze->categorie}}</p>
                <div class="icon">
                    <i class="fas fa-medal" style="color:#CD7F32;font-size:36px;"></i>
                </div>
            </div>
        </div>
    </a>

    @endif

    @if($argent!=null)
    <a href="{{route('visiteboutique',['seller_id'=>$argent->id])}}">
        <div class="card">
            <img src="{{url('/')}}/photosUsers/{{$argent->photo}}" alt="" width="320px;" height="200px;" style="background-size: cover;">
            <div class="card-content">
                <h3 style="color:#FF8000">{{$argent->name}}</h3>
                <p style="color:#FF8000">Categorie: {{$argent->categorie}}</p>
                <div class="icon">
                    <i class="fas fa-medal" style="color:#C0C0C0;font-size:36px;"></i>
                </div>
            </div>
        </div>
    </a>

    @endif

    @if($or!=null)
    <a href="{{route('visiteboutique',['seller_id'=>$or->id])}}">
        <div class="card">
            <img src="{{url('/')}}/photosUsers/{{$or->photo}}" alt="" width="320px;" height="200px;" style="background-size: cover;">
            <div class="card-content">
                <h3 style="color:#FF8000">{{$or->name}}</h3>
                <p style="color:#FF8000">Categorie: {{$or->categorie}}</p>
                <div class="icon">
                    <i class="fas fa-medal" style="color:#FFD700;font-size:36px;"></i>
                </div>
            </div>
        </div>
    </a>

    @endif
    @if($platinium!=null)
    <a href="{{route('visiteboutique',['seller_id'=>$platinium->id])}}">
        <div class="card">
            <img src="{{url('/')}}/photosUsers/{{$platinium->photo}}" alt="" width="320px;" height="200px;" style="background-size: cover;">
            <div class="card-content">
                <h3 style="color:#FF8000">{{$platinium->name}} </h3>
                <p style="color:#FF8000">Categorie: {{$platinium->categorie}}</p>
                <div class="icon">
                    <i class="fas fa-medal" style="color:#E5E4E2;font-size:36px;"></i>
                </div>
            </div>
        </div>
    </a>
    @endif

    @endif

</div>

<!-- Les produits -->
<div class="block2">

    @if (isset($products))
    @foreach ($products as $product)
    @if ($product->user->forfait->statut != 'Bloquer')
    <div class="card2" style="height:max-content;width:250px;">
        <div class="card-content2">
            <div class="phca">
                <img src="{{ url('/') }}/photoProduit/{{ $product->photo }}" alt="Photo">
                <a href="{{ route('produit.detailProduit', $product->id) }}">
                    <button class="details-btn"> Détails</button>
                </a>
            </div>
            <div style="margin-top:5%;display:flex;flex-direction:row;justify-content:space-around;width:100%;">
                <div> {{ $product->nom }} </div>
                <div style="margin-left:auto;">
                    <h4>{{ $product->prix }}FCFA</h4>
                </div>
            </div>
            <a href="{{ route('visiteboutique', ['seller_id' => $product->seller_id]) }}" style="text-decoration:none;">
                <div class="detaills" style="margin-top: 16px;">
                    <div>
                        <div class="storeB">Voir boutique</div>
                    </div>
                </div>
            </a>

            @if ($product->user->forfait->statut != 'impayer')
            <a href="{{ url('add_cart', $product->id) }}" class="add-btn boutton" style="text-decoration:none; text-align:center;">
                <div style="margin-top:10px;">Ajouter au panier</div>
            </a>
            @endif
        </div>
    </div>
    @endif
    @endforeach
    @else

    @php
    $data = Product::orderBy('nom', 'asc')->latest()->take(15)->get();
    @endphp

    @foreach ($data as $item)
    @if ($item->user->forfait->statut != 'Bloquer')
    <div class="card2" style="height:max-content;width:250px;">
        <div class="card-content2">
            <div class="phca">
                <img src="{{ url('/') }}/photoProduit/{{ $item->photo }}" alt="Photo">
                <a href="{{ route('produit.detailProduit', $item->id) }}">
                    <button class="details-btn"> Détails</button>
                </a>
            </div>
            <div style="margin-top:5%;display:flex;flex-direction:row;justify-content:space-around;width:100%;">
                <div> {{ $item->nom }} </div>
                <div style="margin-left:auto;">
                    <h4>{{ $item->prix }}FCFA</h4>
                </div>
            </div>
            <a href="{{ route('visiteboutique', ['seller_id' => $item->seller_id]) }}" style="text-decoration:none;">
                <div class="detaills" style="margin-top: 16px;">
                    <div>
                        <div class="storeB">Voir boutique</div>
                    </div>
                </div>
            </a>

            @if ($item->user->forfait->statut != 'impayer')
            <a href="{{ url('add_cart', $item->id) }}" class="add-btn boutton" style="text-decoration:none; text-align:center;">
                <div style="margin-top:10px;">Ajouter au panier</div>
            </a>
            @endif
        </div>
    </div>
    @endif
    @endforeach
    @endif
</div>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('a.boutton').forEach(function(element) {
            element.addEventListener('click', function(event) {
                event.preventDefault();
                var url = this.href;
                fetch(url, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.error);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    });
</script>