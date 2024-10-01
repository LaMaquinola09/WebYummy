<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-200 leading-tight">
            {{ __('PAGO DE MENSUALIDAD PARA LOS RESTAURANTES') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Necesita realizar el pago para continuar disfrutando del servicio de Yummy.") }}
                </div>
                <div class="container mx-auto py-12">
                    <h2 class="text-3xl font-bold text-center mb-6">Pagar la Tarifa</h2>

                    <div class="max-w-lg mx-auto bg-white p-6 shadow-md rounded-lg">
                        @if (Session::has('success'))
                            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        @endif

                        @if (Session::has('error'))
                            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                                <p>{{ Session::get('error') }}</p>
                            </div>
                        @endif

                        <!-- Formulario para Stripe Checkout -->
                        <form id="checkout-form">
                            @csrf
                            <input type="hidden" name="amount" value="10"> <!-- Monto en centavos -->

                            <!-- Input de Monto -->
                            <div class="mb-4">
                                <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Monto a Pagar (MXN)</label>
                                <input type="number" name="amount" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese el monto a pagar" required>
                            </div>

                            <!-- Botón de Pago -->
                            <button type="button" id="checkout-button" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Pagar $10.00
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Stripe JS -->
                <script src="https://js.stripe.com/v3/"></script>
                <script>
                    var stripe = Stripe('{{ env('STRIPE_KEY') }}');

                    document.getElementById('checkout-button').addEventListener('click', function () {
                        fetch('{{ route('checkout.create') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                amount: 10 // Monto en centavos (5000 = 50.00 USD)
                            }),
                        })
                        .then(function (response) {
                            return response.json();
                        })
                        .then(function (session) {
                            return stripe.redirectToCheckout({ sessionId: session.id });
                        })
                        .then(function (result) {
                            if (result.error) {
                                alert(result.error.message);
                            }
                        })
                        .catch(function (error) {
                            console.error('Error:', error);
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</x-app-layout>