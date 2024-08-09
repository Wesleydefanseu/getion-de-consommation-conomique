<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    //
    public function indexClient()
    {
        return view('walletClient.index');
    }
}
