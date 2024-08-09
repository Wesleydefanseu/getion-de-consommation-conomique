<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayementController extends Controller
{
    //
    public function index()
    {
        return view("Payement.choixMode");
    }
}
