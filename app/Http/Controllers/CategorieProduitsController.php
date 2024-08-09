<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\categorieProduit;
use Carbon\Carbon;

class CategorieProduitsController extends Controller
{
    //
    public function store(Request $request)
    {
        $seller = User::findOrFail(Auth::user()->id);
        $categorie = new categorieProduit();
        $categorie->nom = $request->nom;
        $categorie->seller_id = $seller->id;
        $num = categorieProduit::where('nom', $categorie->nom)->where('seller_id', $seller->id)->count();

        if ($num > 0) {
            toastr()->info('Une categorie portant ce nom existe deja');
            return redirect()->back();
        }

        $categorie->save();
        unset($edit);
        toastr()->success('Categorie ajoutée avec success');

        $title = 'Ajouter';
        $data = CategorieProduit::where('seller_id', Auth::user()->id)->orderBy('nom', 'asc')->get();

        return view('seller.ajouterCategorieProduit', compact('data', 'title'));
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $title = "Modifier";
        $edit = categorieProduit::findOrFail($id);
        $data = CategorieProduit::where('seller_id', Auth::user()->id)->orderBy('nom', 'asc')->get();
        return view("seller.ajouterCategorieProduit", compact("edit", "title", "data"));
    }

    public function update(Request $request, $id)
    {
        $title = "Ajouter";
        $update = categorieProduit::findOrFail($id);
        $request->validate(
            [
                'nom' => 'required',
            ]
        );
        $currentDateTime = Carbon::now();
        $update->updated_at = $currentDateTime->toDateTimeString();
        $update->nom = $request->nom;
        $update->save();

        toastr()->success('Mise a jour effectuer');
        unset($edit);

        $data = CategorieProduit::where('seller_id', Auth::user()->id)->orderBy('nom', 'asc')->get();
        return view('seller.ajouterCategorieProduit', compact('title', 'data'));
    }

    public function delete($id)
    {
        $categorie = CategorieProduit::findOrFail($id);
        $categorie->delete();
        toastr()->success('Suppression effectuer');
        $title = "Ajouter";
        $data = CategorieProduit::where('seller_id', Auth::user()->id)->orderBy('nom', 'asc')->get();
        return view('seller.ajouterCategorieProduit', compact('title', 'data'));
    }
}
