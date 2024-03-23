<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Stoque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $produtos = Produto::all();
        $title = 'SISTEMA DE STOQUE';
        $menu = 'Entradas';
        $type = 'entradas';

        return view('entradas.create', compact('title', 'menu', 'type', 'produtos'));
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

        if (Session::has("lista_de_produtos.$request->produto")) {
            $quantidade = Session::get("lista_de_produtos.$request->produto.quantidade") + 1;
            Session::put("lista_de_produtos.$request->produto.quantidade", $quantidade);
        } else {
            /**definir os valores iniciais */
            $quantidade = 1;
            $lista_de_produtos = [
                'produto_id' => $produto->id,
                'quantidade' => $quantidade,
                'descricao' => $produto->descricao,
            ];
            Session::put("lista_de_produtos.$request->produto", $lista_de_produtos);
        }

        return back()->with('success', "Produto adicionado com sucesso");
    }

    public function removerItem(string $produto_id){
        Session::forget("lista_de_produtos.$produto_id");

    return back()->with('success', "Intem removido com sucesso");
    }


}
