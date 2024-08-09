<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Economie;
use App\Models\User;
use App\Models\Commande;
use Dompdf\dompdf;
use Illuminate\Support\Facades\File;

class Impression extends Controller
{
    public function impression(Request $request)
    {
        $listevendeur = array();
        $photo = $request->input('photoInfo');
        $nom = $request->input('nomInfo');
        $quantite = $request->input('quantiteInfo');
        $taux = $request->input('tauxInfo');
        $prix = $request->input('prixInfo');
        $epargne = $request->input('epargneInfo');

        $date = $request->input('info1');
        $idClient = $request->input('info2');
        $total = $request->input('info3');
        $epargneTotal = $request->input('info4');

        $client=User::findOrFail($idClient);
  
        $dompdf = new Dompdf();
        $html = '
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    
.facture {
    width: 800px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

header {
    background-color: #f0f0f0;
    padding: 10px;
    border-bottom: 1px solid #ccc;
}

header h1 {
    margin-top: 0;
}

.entreprise {
    margin-top: 20px;
}

.entreprise h2 {
    margin-top: 0;
}

.items {
    margin-top: 20px;
}

.items table {
    width: 100%;
    border-collapse: collapse;
}

.items th, .items td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: left;
}

.items th {
    background-color: #f0f0f0;
}

.total {
    margin-top: 20px;
}

.total p {
    font-weight: bold;
    margin-bottom: 10px;
}

footer {
    margin-top: 20px;
    padding-top: 10px;
    border-top: 1px solid #ccc;
}

footer h2 {
    margin-top: 0;
}

footer p {
    margin-bottom: 10px;
}
    </style>
    <title>Document</title>
</head>
<body>
   <div class="activity" id="imp">
        <!-- body -->
        <div class="facture" style="margin-top:12px">
            <header style="text-align:center">
                <h1>FACTURE</h1>
                <p>' .   $date . '</p>
            </header>
            <div class="entreprise">

                <p>Client: ' . $client->name . '</p>
                <p>Téléphone client:' .   $client->telephone . '</p>
                <p>Adresse client:' .   $client->localisation . '</p>
            </div>
            <div class="items">
                <table>
                    <tr>
                        <th>Photo</th>
                        <th>Nom</th>
                        <th>Quantite</th>
                        <th>Taux en %</th>
                        <th>Prix</th>
                        <th>Epargne</th>
                    </tr>
                    ' .
            $this->listeproduit($photo, $nom, $quantite, $taux, $prix, $epargne)
            . '
                </table>
            </div>
            <div class="total" style="text-align:right">
                <p>TOTAL Payer : ' .   $total . ' Fcfa</p>
                <p>TOTAL Epargne : ' . $epargneTotal . 'Fcfa</p>
            </div>
            <footer>
                       <p><b> Boutique :</b>'.Auth::user()->name.'</p>
                        <!-- <p>sitevraimentsuper.fr</p> -->
                        <p><b>Email :</b>'.Auth::user()->email.'</p>
                        <p>'.Auth::user()->localisation.'</p>
                        <p><b>Telephone :</b>'.Auth::user()->telephone.' </p>
                        <h2>Merci pour votre achat</h2>
            </footer>
        </div>
    </div>
</body>
</html>
        ';
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A3', 'portrait');
        $dompdf->render();
        $dompdf->stream('monpdfVendeur_' . time() . '.pdf');
    }

    public function listeproduit($p, $n, $q, $t, $pr, $ep)
    {
        $lignes = '';

        for ($i = 0; $i < count($n); $i++) {

            $lignes = $lignes .
                '<tr>
       <td> <img src="data:image/jpg;base64,' . base64_encode(File::get('photoProduit/' . $p[$i])) . '  " width="90" height="90"> </td>
              <td>  ' . $n[$i] . ' </td>
                <td>  ' . $q[$i] . ' </td>
                  <td>  ' . $t[$i] . ' </td>
                    <td>  ' . $pr[$i] . 'FCFA </td>
                      <td>  ' . $ep[$i] . ' fcfa</td>
            <tr>';
        }
        return $lignes;
    }

 
  
}
