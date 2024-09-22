<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepartidorController extends Controller
{
    public function index()
    {
        // Retorna la vista para los repartidores
        return view('repartidores.index');
    }
}
