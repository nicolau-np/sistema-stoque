<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'SISTEMA DE STOQUE';
        $menu = 'Relatórios';
        $type = 'relatorios';

        return view('relatorios.index', compact('title','menu','type'));
    }

    public function inventario(){

    }

    public function vendaCreate(){

    }

    public function compraCreate(){
        
    }


}
