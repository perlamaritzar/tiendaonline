<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'productos'; // Nombre de la tabla en la base de datos
    protected $fillable = [
        'marca',
        'silueta',
        'modelo',
        'talla',
        'estado',
        'condicion',
        'cantidad',
        'descripcion',
        'precio',
    ];

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}
