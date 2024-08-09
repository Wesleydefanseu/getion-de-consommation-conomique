@if($data!=null)
@foreach ($data as $item)
<a href="{{route('visiteboutique',['seller_id'=>$item->id])}}">
    <div class="card">
        <img src="{{url('/')}}/photosUsers/{{$item->photo}}" alt="" width="320px;" height="200px;" style="background-size: cover;">
        <div class="card-content">
            <h3 style="color:#FF8000">{{$item->name}}</h3>
            <p style="color:#FF8000">Categorie: {{$item->categorie}}</p>
            <div class="icon">

                @if ($item->categorie=='Bronze')
                <i class="fas fa-medal" style="color:#CD7F32;font-size:36px;margin-right:40px;"></i>
                @endif
                @if ($item->categorie=='Argent')
                <i class="fas fa-medal" style="color:#C0C0C0;font-size:36px;margin-right:40px;"></i>
                @endif
                @if ($item->categorie=='Or')
                <i class="fas fa-medal" style="color:#FFD700;font-size:36px;margin-right:40px;"></i>
                @endif
                @if ($item->categorie=='Platine')
                <i class="fas fa-medal" style="color:#E5E4E2;font-size:36px;margin-right:40px;"></i>
                @endif

            </div>
        </div>
    </div>
</a>
@endforeach
@endif