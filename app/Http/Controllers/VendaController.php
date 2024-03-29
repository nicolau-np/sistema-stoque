<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use App\Models\ItemStoque;
use App\Models\Produto;
use App\Models\Stoque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendas = Stoque::where(['tipo' => "Venda", 'estado' => "on"])->orderBy('created_at', 'desc')->paginate(30);
        $title = 'SISTEMA DE STOQUE';
        $menu = 'Venda';
        $type = 'vendas';

        return view('vendas.index', compact('title', 'menu', 'type', 'vendas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produtos = Produto::all();
        $title = 'SISTEMA DE STOQUE';
        $menu = 'Venda';
        $type = 'vendas';

        return view('vendas.create', compact('title', 'menu', 'type', 'produtos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'contacto' => 'required|exists:contactos,id',
            'metodo_pagamento' => 'required|string'
        ], [], [
            'contacto' => 'Fornecedor',
            'metodo_pagamento' => "Método de Pagamento",
        ]);
        $item_stoque = [];
        $total_pagar = 0;
        foreach (Session::get('lista_de_produtos') as $key => $item) {
            $total_pagar = $total_pagar + ($item['quantidade'] * $item['preco_unitario']);
        }

        $stoque = [
            'contacto_id' => $request->contacto,
            'tipo' => "Venda",
            'total_pagar' => $total_pagar,
            'metodo_pagamento' => $request->metodo_pagamento,
            'data_movimento' => date('Y-m-d'),
            'estado' => "on",
        ];

        $stoque = Stoque::create($stoque);
        $item_stoque['stoque_id'] = $stoque->id;

        foreach (Session::get('lista_de_produtos') as $key => $item) {
            $item_stoque['produto_id'] = $item['produto_id'];
            $item_stoque['quantidade'] = $item['quantidade'];
            $item_stoque['preco_unitario'] = $item['preco_unitario'];
            ItemStoque::create($item_stoque);
        }
        Session::forget('lista_de_produtos');
        return redirect('/vendas')->with('success', "Feito com sucesso");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $venda = Stoque::findOrFail($id);

        $title = 'SISTEMA DE STOQUE';
        $menu = 'Venda';
        $type = 'vendas';

        return view('vendas.show', compact('title', 'menu', 'type', 'venda'));
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
        $entrada = Stoque::findOrFail($id);

        $entrada->delete();

        return redirect('/vendas')->with('success', "Eliminada com sucesso");
    }

    public function adicionarItem(Request $request)
    {
        $this->validate($request, [
            'produto' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        $lista_de_produtos = [];

        $produto = Produto::findOrFail($request->produto);

        if (Session::has("lista_de_produtos.$request->produto")) {
            $quantidade = Session::get("lista_de_produtos.$request->produto.quantidade") + $request->quantidade;
            Session::put("lista_de_produtos.$request->produto.quantidade", $quantidade);
        } else {
            /**definir os valores iniciais */
            $lista_de_produtos = [
                'produto_id' => $produto->id,
                'quantidade' => $request->quantidade,
                'descricao' => $produto->descricao,
                'preco_unitario' => $produto->preco_unitario,
            ];
            Session::put("lista_de_produtos.$request->produto", $lista_de_produtos);
        }

        return back()->with('success', "Produto adicionado com sucesso");
    }

    public function removerItem(string $produto_id)
    {
        Session::forget("lista_de_produtos.$produto_id");

        return back()->with('success', "Intem removido com sucesso");
    }

    public function definirContacto()
    {
        if (!Session::has('lista_de_produtos'))
            return back()->with('error', "Deve adicionar produtos no carrinho");

        $contactos = Contacto::where('tipo', "Cliente")->get();
        $title = 'SISTEMA DE STOQUE';
        $menu = 'Venda';
        $type = 'vendas';

        return view('vendas.definir-contacto', compact('title', 'menu', 'type', 'contactos'));
    }
}
