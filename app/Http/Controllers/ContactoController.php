<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contactos = Contacto::paginate(10);
        $title = 'SISTEMA DE STOQUE';
        $menu = 'Contactos';
        $type = 'contactos';

        return view('contactos.index', compact('title','menu','type','contactos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'SISTEMA DE STOQUE';
        $menu = 'Contactos';
        $type = 'contactos';

        return view('contactos.create', compact('title','menu','type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'descricao'=>'required|string',
            'tipo'=>'required|string',
            'morada'=>'required|string',
            'provincia'=>'required|string',
            'municipio'=>'required|string',
        ],[],[]);

        $contacto = Contacto::create($request->all());

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
        $contacto = Contacto::findOrFail($id);
        $title = 'SISTEMA DE STOQUE';
        $menu = 'Contactos';
        $type = 'contactos';

        return view('contactos.edit', compact('title','menu','type','contacto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contacto = Contacto::findOrFail($id);

        $this->validate($request, [
            'descricao'=>'required|string',
            'tipo'=>'required|string',
            'morada'=>'required|string',
            'provincia'=>'required|string',
            'municipio'=>'required|string',
        ],[],[]);

        $contacto->update($request->all());

        return back()->with('success', "Feito com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contacto = Contacto::findOrFail($id);
        $contacto->delete();

        return redirect('/contactos')->with('success', "Eliminado com sucesso");
    }
}
