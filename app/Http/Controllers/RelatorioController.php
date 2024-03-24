<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Stoque;
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
        $produtos = Produto::orderBy('descricao', 'asc')->get();

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

    public function compraPrint(Request $request)
    {
        $this->validate($request, [
            'data_inicial' => 'required|date',
            'data_final' => 'required|date'
        ]);

        $compras = Stoque::where('tipo', "Compra")
            ->whereBetween('data_movimento', [$request->data_inicial, $request->data_final])
            ->orderBy('data_movimento', 'desc')->get();
        $data_inicial = $request->data_inicial;
        $data_final = $request->data_final;

        $pdf = PDF::loadView('relatorios.relatorio-compra', compact('data_inicial', 'data_final', 'compras'))->setPaper('A4', 'normal');
        return $pdf->stream("relatorio-compra.pdf");
    }
}
