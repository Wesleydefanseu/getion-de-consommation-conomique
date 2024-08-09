@if (isset($products))
<!--  -->
@if ($products !=null)
@foreach ($products as $item )
<div class="card" style="margin-bottom:20px;margin-left:auto;margin-right:auto">
    <div class="">
        <img class="imageCard" src="{{url('/')}}/photoProduit/{{$item->photo }}" style="border-radius:12px;" alt="" height="200px">
    </div>
    <div class="card-content" style="height:max-content;margin-top:10px;" style="border-radius:12px;">
        <div class="ligne" style="border-radius:12px;">
            <div class="text" style="width:100%">
                <h3 style="margin-left:10px">{{$item->nom}}</h3>

                <a href="{{route('produit.detailProduit',$item->id)}}" style="text-decoration: none;">
                    <div class="detaills" style="width:100%">

                        <h3 style="font-size:small;color:#FF8000;margin-left:10px">Prix: {{$item->prix}}FCFA</h3>
                        <h3 style="font-size:small;color:#FF8000;margin-left:10px">Taux: {{$item->taux}} %</h3>
                        <p style="font-size:small;color:gray;margin-left:10px">Description:{{$item->description}}</p>
                    </div>
                </a>
                @if ($item->user->forfait->statut!='impayer')
                <a class="add-btn boutton" href="{{url('add_cart',$item->id)}}" style="text-decoration: none;">
                    <div class="bouton" style="margin-left:auto;margin-right:auto;margin-top:20px">
                        <button class="butt " type="button"  style="color:white;font-weight:bold">Ajouter panier</button>
                    </div>
                </a>
                @endif

            </div>

        </div>

    </div>
</div>



@endforeach

@endif
<!--  -->
@else
@if ($Produitboutique !=null)
@foreach ($Produitboutique as $item )
<div class="card" style="margin-bottom:100px;margin-left:auto;margin-right:auto">
    <div class="">
        <img class="imageCard" src="{{url('/')}}/photoProduit/{{$item->photo }}" style="border-radius:12px;" alt="" height="200px">
    </div>
    <div class="card-content" style="height:max-content;margin-top:10px;" style="border-radius:12px;">
        <div class="ligne" style="border-radius:12px;">
            <div class="text" style="width:100%">
                <h3 style="margin-left:10px">{{$item->nom}}</h3>

                <a href="{{route('produit.detailProduit',$item->id)}}" style="text-decoration: none;">
                    <div class="detaills" style="width:100%">

                        <h3 style="font-size:small;color:#FF8000;margin-left:10px">Prix: {{$item->prix}}FCFA</h3>
                        <h3 style="font-size:small;color:#FF8000;margin-left:10px">Taux: {{$item->taux}} %</h3>
                        <p style="font-size:small;color:gray;margin-left:10px">Description:{{$item->description}}</p>
                    </div>
                </a>
                @if ($item->user->forfait->statut!='impayer')
                <a class="add-btn boutton" href="{{url('add_cart',$item->id)}}" style="text-decoration: none;">
                    <div class="bouton" style="margin-left:auto;margin-right:auto;margin-top:20px ;">
                        <button class="butt" type="button" style="color:white;font-weight:bold">Ajouter panier</button>
                    </div>
                </a>
                @endif

            </div>

        </div>

    </div>
</div>



@endforeach

@endif
@endif


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