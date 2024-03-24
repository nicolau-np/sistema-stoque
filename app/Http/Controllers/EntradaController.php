<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use App\Models\ItemStoque;
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
        $this->validate($request, [
            'contacto' => 'required|exists:contactos,id',
        ], [], [
            'contacto' => 'Fornecedor',
        ]);
        $item_stoque = [];

        $stoque = [
            'contacto_id' => $request->contacto,
            'tipo' => "Entrada",
            'data_movimento' => date('Y-m-d'),
            'estado' => "on",
        ];

        $stoque = Stoque::create($stoque);
        $item_stoque['stoque_id'] = $stoque->id;

        foreach (Session::get('lista_de_produtos') as $key => $item) {
            $item_stoque['produto_id'] = $item['produto_id'];
            $item_stoque['quantidade'] = $item['quantidade'];

            ItemStoque::create($item_stoque);
        }
Session::forget('lista_de_produtos');
        return redirect('/entradas')->with('success', "Feito com sucesso");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $entrada = Stoque::findOrFail($id);

        $title = 'SISTEMA DE STOQUE';
        $menu = 'Entradas';
        $type = 'entradas';

        return view('entradas.show', compact('title', 'menu', 'type', 'entrada'));
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

        return redirect('/entradas')->with('success', "Eliminada com sucesso");
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

        $contactos = Contacto::where('tipo', "Fornecedor")->get();
        $title = 'SISTEMA DE STOQUE';
        $menu = 'Entradas';
        $type = 'entradas';

        return view('entradas.definir-contacto', compact('title', 'menu', 'type', 'contactos'));
    }
}
