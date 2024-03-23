<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
       'descricao',
         'preco_unitario',
          'estado',
    ];

    public function itemStoque(){
        return $this->hasMany(ItemStoque::class, 'produto_id');
    }
}
