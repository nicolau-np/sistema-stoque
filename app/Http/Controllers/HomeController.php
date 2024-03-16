<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'SISTEMA DE STOQUE';
        $menu = 'Home';
        $type = 'home';

        return view('index', compact('title', 'menu', 'type'));
    }
}
