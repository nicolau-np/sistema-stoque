<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    protected $fillable = [
            'descricao',
            'tipo',//fornecedor ou cliente
            'telefone',
            'morada',
            'provincia',
            'municipio',
    ];

    public function stoque(){
        return $this->hasMany(Stoque::class, 'contacto_id');
    }
}
