<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalController extends Controller
{
    /**
     * Muestra los Términos y Condiciones.
     */
    public function terminos()
    {
        return view('legal.terminos');
    }

    /**
     * Muestra el Aviso de Privacidad.
     */
    public function avisoPrivacidad()
    {
        return view('legal.aviso_privacidad');
    }
}
