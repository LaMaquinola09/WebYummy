<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Categoria;

    class Restaurante extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'restaurantes';

    /**
     * Los atributos que se pueden asignar de forma masiva.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nombre',
        'direccion',
        'telefono',
        'horario',
        'estado',
        'categoria_id',
        'estado_membresia',
        'imagen',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


        public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function categoria()
        {
            return $this->belongsTo(Categoria::class);
        }
    
    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'restaurante_id');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }


}