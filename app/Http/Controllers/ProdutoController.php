<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::paginate(10);
        $title = 'SISTEMA DE STOQUE';
        $menu = 'Produtos';
        $type = 'produtos';

        return view('produtos.index', compact('title','menu','type','produtos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $title = 'SISTEMA DE STOQUE';
        $menu = 'Produtos';
        $type = 'produtos';

        return view('produtos.create', compact('title','menu','type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'descricao'=>'required|string',
            'preco_unitario'=>'required|numeric|min:1'
        ],[],[]);

        $produto = Produto::create($request->all());

        return back()->with('success', "Feito com sucesso");
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
        $produto = Produto::findOrFail($id);
        $title = 'SISTEMA DE STOQUE';
        $menu = 'Produtos';
        $type = 'produtos';

        return view('produtos.edit', compact('title','menu','type', 'produto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $produto = Produto::findOrFail($id);

        $this->validate($request, [
            'descricao'=>'required|string',
            'preco_unitario'=>'required|numeric|min:1'
        ],[],[]);

        $produto->update($request->all());

        return back()->with('success', "Feito com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produto = Produto::findOrFail($id);

        $produto->delete();

        return redirect('/produtos')->with('success', "Feito com sucesso");
    }
}
