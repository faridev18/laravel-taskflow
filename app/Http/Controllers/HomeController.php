<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        $data = "Hello world";
        return view('home')->with("data",$data);
    }

    public function products(){
        return view('products');
    }
}
