<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['cliente_id', 'produto_id'];

    public static $rules = [
        'cliente_id' => 'required|string',
        'produto_id' => 'required|string',
    ];

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'pedido_produtos')->withTimestamps();
    }
}
