<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stoque extends Model
{
    use HasFactory;

    protected $fillable = [
        'contacto_id',
        'metodo_pagamento',
        'total_pagar',
        'tipo',
        'data_movimento',
        'estado',
    ];

    public function contacto()
    {
        return $this->belongsTo(Contacto::class, 'contacto_id');
    }

    public function itemStoque()
    {
        return $this->hasMany(ItemStoque::class, 'stoque_id');
    }
}
