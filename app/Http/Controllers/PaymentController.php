<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Session; 

class PaymentController extends Controller
{

    public function handlePayment(Request $request)
    {
        // Establecer la clave secreta de Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Charge::create([
                'amount' => $request->amount * 100, // El monto debe estar en centavos
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Pago de la tarifa del restaurante',
            ]);

            // Redirigir con mensaje de éxito
            Session::flash('success', 'Pago realizado con éxito.');
            return redirect()->route('pay_fee');

        } catch (\Exception $e) {
            // En caso de error, redirigir con mensaje de error
            Session::flash('error', $e->getMessage());
            return redirect()->route('pay_fee');
        }
    }
}
