<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\categorieProduit;

class SearchController extends Controller
{
    //

    public function searchBoutiqueC(Request $request)
    {
        $rechearch = $request->rechearch;
        $categorie = $request->categorietype;
        $data = User::where('usertype', 'seller')
            ->where('categorie', 'LIKE', "%{$categorie}%")
            ->where('name', 'LIKE', "%{$rechearch}%")->get();
        if ($request->ajax()) {
            return view('resultats.resultaBoutiqueC', compact('data', 'categorie'))->render();
        }


        return view('boutiqueCategorie', compact('data', 'categorie', 'rechearch'));
    }

    public function searchDashboard(Request $request)
    {

        $query = $request->input('query');

        // Rechercher des produits par nom ou description ou par catégorie
        $products = Product::where('nom', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->orWhereHas('categorieProduit', function ($q) use ($query) {
                $q->where('nom', 'LIKE', "%{$query}%");
            })
            ->get();

        $sellers = User::where('usertype', 'seller')
            ->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhereHas('categorieProduits', function ($q) use ($query) {
                        $q->where('nom', 'LIKE', "%{$query}%")
                            ->orWhereHas('products', function ($q) use ($query) {
                                $q->where('nom', 'LIKE', "%{$query}%")
                                    ->orWhere('description', 'LIKE', "%{$query}%");
                            });
                    });
            })
            ->get();



        if ($request->ajax()) {
            return view('resultats.resultat', compact('sellers', 'products'))->render();
        }


        return view('dashboard', compact('sellers', 'products', 'query'));
    }

    public function searchTest(Request $request)
    {
        $query = $request->input('query');
        $seller_id = (int)$request->idSeller;

        $products = Product::where(function ($q) use ($query, $seller_id) {
            $q->where('nom', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->orWhereHas('categorieProduit', function ($q) use ($query, $seller_id) {
                    $q->where('nom', 'LIKE', "%{$query}%")
                        ->where('seller_id', $seller_id);
                });
        })
            ->where('seller_id', $seller_id)
            ->get();

        if ($request->ajax()) {
            return view('resultats.resultat2', compact('products'))->render();
        }


        return view('test', compact('seller_id', 'products', 'query'));
    }


    public function superadminsearchTest(Request $request)
    {
        $type = '';
        $view = '';
        $page = (int)$request->page;
        $query = $request->input('query');
        if ($page == 1) {
            $type = 'admin';
            $view = 'admin';
        }
        if ($page == 2) {
            $type = 'seller';
            $view = 'vendeur';
        }
        if ($page == 3) {
            $type = 'user';
            $view = 'client';
        }
        if ($page == 4) {
            $type = 'user';
            $view = 'commandes';
        }


        $dataUser = User::where(function ($q) use ($query,  $type) {
            $q->where('name', 'LIKE', "%{$query}%")
                ->orWhere('telephone', 'LIKE', "%{$query}%")
                ->orWhere('email', 'LIKE', "%{$query}%");
        })
            ->where('usertype', $type)
            ->get();

        if ($page == 2) {
            $dataUser = User::where(function ($q) use ($query,  $type) {
                $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('telephone', 'LIKE', "%{$query}%")
                    ->orWhere('email', 'LIKE', "%{$query}%")
                    ->orWhere('categorie', 'LIKE', "%{$query}%");
            })
                ->where('usertype', $type)
                ->get();
        }

        if ($page == 4) {
            $dataUser = User::where(function ($q) use ($query,  $type) {
                $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('telephone', 'LIKE', "%{$query}%")
                    ->orWhere('email', 'LIKE', "%{$query}%");
            })
                ->where('usertype', $type)
                ->pluck('id')->toArray();
        }

        if ($page == 1 || $page == 2 || $page == 3 || $page == 4) {
            return view('superadmin.' . $view . '', compact('dataUser', 'query'));
        }
    }
}
