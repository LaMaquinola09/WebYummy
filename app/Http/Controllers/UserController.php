<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Retorna la vista para los repartidores
        return view('usuarios.index');
    }
}
