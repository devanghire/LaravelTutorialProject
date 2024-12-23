<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //FOR SQL QUERYS

class HomeController extends Controller
{
    public function home_firstFunction(){
        return view('home_first');
    }
    public function home_secondFunction()
    {
        return view('home_second');
    }
    public function home_theirdFunction(string $name)
    {   
        return view('home_theird',compact('name'));
    }
}
