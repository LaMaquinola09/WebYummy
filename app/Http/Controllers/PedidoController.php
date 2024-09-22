<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        // Retorna la vista para los pedidos
        return view('pedidos.index');
    }
}
