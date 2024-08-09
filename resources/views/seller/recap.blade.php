@php
use App\Models\User;
use App\Models\Product;
use App\Models\Economie;
use Illuminate\Support\Facades\Auth;

$data1 =Economie::all();
$totalProduit = Product::where('seller_id', Auth::user()->id)->count();
$totalEconomie=0;
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

<ul class="box-info" style="text-align:center">

    <div class="box-info " style="width:300px;height:150px;margin-left:auto;margin-right:auto">

        <li class="card">
            <i class="fa fa-users" style="font-size:46px"></i>
            <span class="text">
                <h3 style="color:#ff8000">{{$totalclient}}</h3>
                <p>Total Clients</p>
            </span>
        </li>

    </div>

    <div class="box-info " style="width:300px;height:150px;margin-left:auto;margin-right:auto">

        <li class="card">
            <i class="fas fa-hand-holding-usd" style="font-size:46px"></i>
            <span class="text">
                <h3 style="color:#ff8000">{{$totalEconomie}} FCFA</h3>
                <p>Economies client</p>
            </span>
        </li>

    </div>

    <div class="box-info " style="width:300px;height:150px;margin-left:auto;margin-right:auto">

        <li class="card">
            <i class="fa fa-book" style="font-size:46px"></i>
            <span class="text">
                <h3 style="color:#ff8000">{{$totalProduit}}</h3>
                <p>Produits</p>
            </span>
        </li>

    </div>

 

</ul>