<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Stoque;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entradas = Stoque::paginate(10);
        $title = 'SISTEMA DE STOQUE';
        $menu = 'Entradas';
        $type = 'entradas';

        return view('entradas.index', compact('title', 'menu', 'type', 'entradas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'SISTEMA DE STOQUE';
        $menu = 'Entradas';
        $type = 'entradas';

        return view('entradas.create', compact('title', 'menu', 'type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function adicionarItem(Request $request)
    {
        $this->validate($request, [
            'produto' => 'required|exists:produtos,id'
        ]);

        $lista_de_produtos = [];

        $produto = Produto::findOrFail($request->produto);

        
    }
}
