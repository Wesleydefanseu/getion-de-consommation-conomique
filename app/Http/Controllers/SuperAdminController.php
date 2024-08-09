<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    //
    public function detailboutique($id)
    {
        return view('superadmin.vueVendeur', compact('id'));
    }
    public function modifierBoutique(Request $request)
    {
        $id = $request->sellerId;
        $seller=User::findOrFail($id);
        $seller->forfait->type=$request->categorie;
        $seller->categorie=$request->categorie;

        $seller->forfait->dette=$request->dette;
        $seller->forfait->statut=$request->statut;

        $seller->forfait->save();
        $seller->save();
        toastr()->success('Modification effectuer');
        return redirect()->back();
    }
}
