<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    // Define la tabla si el nombre no sigue el estándar de Laravel
    protected $table = 'comentarios';

    // Define los campos que pueden ser asignados de forma masiva
    protected $fillable = ['cliente_id', 'restaurante_id', 'comentario', 'calificacion', 'fecha'];

    // Relación con el modelo Cliente
    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    // Relación con el modelo Restaurante
    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class, 'restaurante_id');
    }
}
