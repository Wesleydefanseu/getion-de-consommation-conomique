<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photoproduit;
use App\Models\PhotoUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    //
    public function seller(Request $request)
    {
       
         // Valider les fichiers
        $request->validate([
            'photoInit' => 'required|array',
            'photoInit.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Récupérer les fichiers
        $photos = $request->file('photoInit');

        if ($photos) {
            // Parcourir et enregistrer chaque fichier
            foreach ($photos as $photo) {
                $tof=new PhotoUser();
                // Générer un nom unique pour chaque fichier
                $photoName = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
                $tof->imageV=  $photoName ;
                // Enregistrer le fichier dans le dossier "Images" situé dans public
                $photo->move(public_path('New_pages/AjoutPhotoVendeur/photo'), $photoName);
                $tof->seller_id=Auth::user()->id;
                $tof->save();
            }
        }

        return redirect()->back();
    }

}
