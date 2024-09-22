<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Cambiado a 'nombre'
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('direccion')->nullable(); // Nueva columna para dirección
            $table->string('telefono')->nullable(); // Nueva columna para teléfono
            $table->date('fecha_nacimiento')->nullable(); // Nueva columna para fecha de nacimiento
            $table->enum('vehiculo', ['moto', 'bicicleta', 'ninguno'])->nullable(); // Nueva columna para vehículo
            $table->enum('rol', ['cliente', 'repartidor', 'restaurante'])->default('restaurante'); // Nueva columna para rol
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
