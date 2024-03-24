<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use App\Models\Produto;
use App\Models\Stoque;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        $vendas = Stoque::where(['tipo'=>"Venda",'estado'=>'on'])->get();
        $contactos = Contacto::all();
        $users = User::all();
        $title = 'SISTEMA DE STOQUE';
        $menu = 'Home';
        $type = 'home';

        return view('index', compact('title', 'menu', 'type', 'produtos', 'vendas', 'contactos', 'users'));
    }
}
