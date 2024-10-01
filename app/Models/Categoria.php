<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Restaurante;


class Categoria extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nombre'
    ];

    public function restaurantes()
    {
        return $this->hasMany(Restaurante::class);
    }
}

