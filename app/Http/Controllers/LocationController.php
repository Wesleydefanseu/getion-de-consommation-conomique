<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
class LocationController extends Controller
{
    public function index(Request $request)
    {
        $user=$request->ip();
       // $user=$_SERVER['REMOTE_ADDR'];
        // $user='66.102.0.0';
        $location=Location::get($user);
        return view('location',compact('location'));
    }
}
