<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurante;

class CheckoutController extends Controller
{
    public function createCheckoutSession(Request $request)
    {
        // Establecer la clave secreta de Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Crear una sesión de pago en Stripe
        $checkoutSession = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'mxn',
                    'product_data' => [
                        'name' => 'Tarifa del Restaurante',
                    ],
                    'unit_amount' => $request->amount * 100, // Convertir a centavos
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
        ]);

        // Redirigir al usuario a la página de pago de Stripe
        return response()->json(['id' => $checkoutSession->id]);
    }

    public function success(Request $request)
    {
        // Verificar que la sesión de Stripe sea válida
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::retrieve($request->query('session_id'));

        if ($session && $session->payment_status == 'paid') {
            // Obtener el usuario autenticado
            $user = Auth::user();

            // Verificar si el usuario tiene un restaurante asociado
            if ($user->tipo === 'restaurante') {
                $restaurante = Restaurante::where('user_id', $user->id)->first();

                if ($restaurante) {
                    // Actualizar el campo estado_membresia del restaurante
                    $restaurante->update([
                        'estado_membresia' => 'Y',
                        'paid_at' => date('Y-m-d H:i:s')
                    ]);

                    // Mostrar un mensaje de éxito
                    return view('restaurantes.success')->with('message', 'Pago realizado con éxito. Tu membresía ha sido activada.');
                }
            }
        }

        // Si algo falla, mostrar un error
        return view('restaurantes.error', ['error' => 'Error al procesar el pago.']);
    }

    public function cancel()
    {
        return view('restaurantes.cancel');
    }
}
