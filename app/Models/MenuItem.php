<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurante_id', 
        'nombre_producto', 
        'descripcion', 
        'precio', 
        'imagen_url'
    ];

    public function restaurante() {
        return $this->belongsTo(Restaurante::class);
    }
}