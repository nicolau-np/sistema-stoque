<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemStoque extends Model
{
    use HasFactory;

    protected $fillable = [
        'stoque_id',
        'produto_id',
         'preco_unitario',
         'quantidade',
         'observacao',
          'estado',
    ];

    public function produto(){
        return $this->belongsTo(Produto::class, 'produto_id');
    }

    public function stoque(){
        return $this->belongsTo(Stoque::class, 'stoque_id');
    }
}
