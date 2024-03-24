<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use PDF;

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

        return view('relatorios.index', compact('title', 'menu', 'type'));
    }

    public function inventario()
    {
        $produtos = Produto::orderBy('descricao','asc')->get();

        $pdf = PDF::loadView('relatorios.inventario', compact('produtos'))->setPaper('A4', 'normal');
        return $pdf->stream("relatorios.pdf");
    }

    public function vendaCreate()
    {
    }

    public function compraCreate()
    {
        $title = 'SISTEMA DE STOQUE';
        $menu = 'Relatório de Compra';
        $type = 'relatorios';

        return view('relatorios.create-compra', compact('title', 'menu', 'type'));
    }
}
