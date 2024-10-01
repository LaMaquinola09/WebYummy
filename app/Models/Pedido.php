<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;


    protected $fillable = [
        'cliente_id',
        'restaurante_id',
        'repartidor_id',
        'direccion_entrega_id',
        'estado',
        'fecha_pedido',
        'metodo_pago_id',
    ];


    // Definir las columnas de fecha
     protected $dates = ['fecha_pedido'];



    //Crear las relaciones de las tablas 
       // Relación con el modelo User para cliente
       public function cliente()
       {
           return $this->belongsTo(User::class, 'cliente_id');
       }
   
       // Relación con el modelo User para restaurante
       public function restaurante()
       {
           return $this->belongsTo(User::class, 'restaurante_id');
       }
   
       // Relación con el modelo User para repartidor (opcional)
       public function repartidor()
       {
           return $this->belongsTo(User::class, 'repartidor_id');
       }
   
       // Relación con DireccionEntrega
       public function direccionEntrega()
       {
           return $this->belongsTo(DireccionEntrega::class, 'direccion_entrega_id');
       }
   
       // Relación con MetodoPago
       public function metodoPago()
       {
           return $this->belongsTo(MetodoPago::class, 'metodo_pago_id');
       }









}