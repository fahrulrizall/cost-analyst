<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home(){
        return view('index');
    }

    public function about(){
        return view('about',['nama' => 'Fahrul Rizal']);
    }
}
