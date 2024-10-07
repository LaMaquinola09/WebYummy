<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Los atributos que se pueden asignar de forma masiva.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'email',
        'tipo',
        'direccion',
        'telefono',
        'password'
    ];


    public function restaurante()
    {
        return $this->hasOne(Restaurante::class, 'user_id'); // 'user_id' es la clave foránea en la tabla restaurantes
    }
    






    public function scopeRepartidores($query)
    {
        return $query->where('tipo', 'repartidor');
    }

    public function scopeUsuarios($query)
    {
        return $query->where('tipo', 'usuario');
    }

    /**
     * Los atributos que deben ocultarse para la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}