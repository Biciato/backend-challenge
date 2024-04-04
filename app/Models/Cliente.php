<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'phone', 'birthdate', 'address', 'complement', 'neighborhood', 'postal_code'];

    public static $rules = [
        'name' => 'required|string',
        'phone' => 'required|string',
        'birthdate' => 'required|date',
        'address' => 'required|string',
        'neighborhood' => 'required|string',
        'postal_code' => 'required|string',
        'email' => 'required|email|unique:clientes,email',
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
