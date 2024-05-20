<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        return view('home.homepage');
    }

    public function index(){
        return view('home.homepage');
    }

    public function about()
    {
        return view('home.about');
    }

    public function shop()
    {
        return view('home.shop');
    }

    public function contact()
    {
        return view('home.contact');
    }


}
