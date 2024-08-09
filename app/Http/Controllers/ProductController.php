<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\categorieProduit;
use App\Models\Photoproduit;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    // //
    public function store(Request $request)
    {

        $nbrAuto = 0;
        if (Auth::user()->categorie == 'Bronze') {
            $nbrAuto = 5;
        }
        if (Auth::user()->categorie == 'Argent') {
            $nbrAuto = 10;
        }
        if (Auth::user()->categorie == 'Platine') {
            $nbrAuto = 15;
        }
        if (Auth::user()->categorie == 'Or') {
            $nbrAuto = 20;
        }
        $count = Product::where('seller_id', Auth::user()->id)->count();

        if ($count  >=  $nbrAuto) {
            toastr()->warning('Vous avez atteint le nombre maximal de produit a enregistrer . Veuillez booster votre forfait ');
            return redirect()->back();
        }
        $pdt = new Product();
        $pdt->nom = $request->nom;
        $pdt->prix = $request->prix;
        $pdt->description = $request->description;
        $pdt->seller_id = Auth::user()->id;
        $pdt->quantite = $request->qty;
        $pdt->taux = $request->taux;
        $pdt->categorieprod_id = $request->categorie;
        if ($pdt->taux < 0 || $pdt->quantite < 0 || $pdt->prix < 0) {
            //  $messaggError="Ve";
            toastr()->info('Remplissez correctement les champs : taux ,quantite,prix');
            return redirect()->back();
        }


        if ($request->hasFile('photto')) {

            $file = $request->file('photto');
            $file_name = time() . $file->getClientOriginalName();
            $file->move(public_path('photoProduit'), $file_name);
            $pdt->photo = $file_name;
        }

        $pdt->save();
        toastr()->success('Produit ajouter avec succes');

        $data = Product::where('seller_id', Auth::user()->id)->orderBy('nom', 'asc')->get();
        $datanamecatg = CategorieProduit::all();

        // $sumtof = Photoproduit::where('product_id', $pdt->id)->count();
        // if ($sumtof >= 4) {
        //     toastr()->info('Vous avez atteint le nombre maximal de photo a enregistrer ');
        //     return redirect()->back();
        // }
        // ///
        $request->validate([
            'photoV' => 'required|array',
            'photoV.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $tofs = $request->file('photoV');

        if ($tofs) {
            // Parcourir et enregistrer chaque fichier
            foreach ($tofs as $items) {
                $tof = new Photoproduit();
                // Générer un nom unique pour chaque fichier
                $photoName = time() . '_' . uniqid() . '.' . $items->getClientOriginalExtension();
                $tof->imageV =  $photoName;
                // Enregistrer le fichier dans le dossier "Images" situé dans public
                $items->move(public_path('New_pages/AjoutPhotoProduit/photo'), $photoName);
                $tof->product_id = $pdt->id;
                $tof->save();
            }
        }
        //
  
        return view('seller.listingProduit2', compact('data', 'datanamecatg'));
    }


    public function edit($id)
    {
        $title = "Modifier";
        $edit = Product::findOrFail($id);
        $data = CategorieProduit::where('seller_id', Auth::user()->id)->orderBy('nom', 'asc')->get();

        return view("seller.ajouterproduit", compact("edit", "title", "data"));
    }

    public function update(Request $request, $id)
    {
        $title = "Inscription";
        $update = Product::findOrFail($id);
        $request->validate(
            [

                'nom' => 'required',
                'prix' => 'required',
                'description' => 'required',
                'qty' => 'required',
                'taux' => 'required',
                'categorie' => 'required',
            ]
        );

        if ($request->hasFile('photto')) {

            $file = $request->file('photto');
            $file_name = time() . $file->getClientOriginalName();
            if ($request->oldphoto != '') {
                $file_name = $request->oldphoto;
            }
            $file->move(public_path('photoProduit'), $file_name);
            $update->photo = $file_name;
        }

        $update->nom = $request->nom;
        $update->prix = $request->prix;
        $update->description = $request->description;
        $update->seller_id = Auth::user()->id;
        $update->quantite = $request->qty;
        $update->taux = $request->taux;
        $update->categorieprod_id = $request->categorie;


        $update->save();
        unset($edit);


        $data = Product::where('seller_id', Auth::user()->id)->orderBy('nom', 'asc')->get();
        $datanamecatg = CategorieProduit::all();
        ///
        $sumtof = Photoproduit::where('product_id', $update->id)->count();




        $request->validate([
            'photoV' => 'required|array',
            'photoV.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $tofs = $request->file('photoV');

        if ($sumtof >= 4 || count($tofs)+$sumtof >= 4) {
            toastr()->info('Vous avez atteint le nombre maximal de photo a enregistrer ');
            return redirect()->back();
        }



        if ($tofs) {
            // Parcourir et enregistrer chaque fichier
            foreach ($tofs as $items) {
                $tof = new Photoproduit();
                // Générer un nom unique pour chaque fichier
                $photoName = time() . '_' . uniqid() . '.' . $items->getClientOriginalExtension();
                $tof->imageV =  $photoName;
                // Enregistrer le fichier dans le dossier "Images" situé dans public
                $items->move(public_path('New_pages/AjoutPhotoProduit/photo'), $photoName);
                $tof->product_id = $update->id;
                $tof->save();
            }
        }
        //
        toastr()->success('Mise a jour effectuer');

        return view('seller.listingProduit2', compact('data', 'datanamecatg'));
    }

    public function delete($id)
    {
        $categorie = Product::findOrFail($id);
        $categorie->delete();

        $data = Product::where('seller_id', Auth::user()->id)->orderBy('nom', 'asc')->get();
        $datanamecatg = CategorieProduit::all();
        toastr()->success('Suppression effectuer');
        return view('seller.listingProduit2', compact('data', 'datanamecatg'));
    }
    public function BoutiqueCategorieSpecial($id)
    {
        $Produitboutique = Product::where('categorieprod_id', $id)->orderBy('created_at', 'desc')->get();
        $ct = categorieProduit::findOrFail($id);
        $seller_id = $ct->seller_id;
        $idCat = $id;
        return view("test", compact("Produitboutique", 'seller_id', 'idCat'));
    }


    public function deleteTof($id)
    {
        $tof = Photoproduit::findOrFail($id);

        $this->deleteFile('New_pages/AjoutPhotoProduit/photo/'.$tof->imageV);
        $tof->delete();
        toastr()->success('Suppression effectuer');
        return redirect()->back();
    }

    public function deleteFile($filePath)
    {
        // Chemin complet du fichier
        $fullPath = public_path($filePath);

        // Vérifier si le fichier existe
        if (File::exists($fullPath)) {
            // Supprimer le fichier
            File::delete($fullPath);
            return response()->json(['success' => 'Fichier supprimé avec succès.']);
        } else {
            return response()->json(['error' => 'Fichier non trouvé.'], 404);
        }
    }
}
