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
            'descricao'=>,
            'tipo',
            'morada',
            'provincia',
            'municipio',
        ],[],[]);
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
}
