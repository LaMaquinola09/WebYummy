<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\RepartidorDashboardController; // Asegúrate de crear este controlador
use App\Http\Controllers\RestauranteDashboardController; // Asegúrate de crear este controlador
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\RepartidorController;
use App\Http\Controllers\LegalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});


// Ruta para mostrar el formulario de registro de solicitud
Route::get('/registrosolicitud', [SolicitudController::class, 'create'])->name('Registrosolicitud');

// Ruta para almacenar la solicitud
Route::post('/solicitudes', [SolicitudController::class, 'store'])->name('solicitudes.store');


Route::put('/restaurant/{id}/update-status', [RestauranteController::class, 'updateStatus'])->name('restaurant.update.status');









Route::group(['middleware' => ['auth', 'check.restaurant.active']], function () {
    // Rutas accesibles solo para restaurantes activos
        // Ruta general del dashboard
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->middleware(['auth', 'verified'])->name('adminDash');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // Te amo Cielo
    // Atte Fernando
    //Rutas para el pedidos
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    // Ruta para obtener los pedidos
    Route::get('/api/pedidos', [PedidoController::class, 'listarPedidos']);


 

    Route::get('/reporteventas', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/reporteestadisticas', [ReporteController::class, 'generarReporteEstadistica'])
    ->name('pedidos.estadistica');










    // Ruta para obtener el número de notificaciones
    Route::get('/api/notificaciones', [PedidoController::class, 'getNotificaciones']);
    // Ruta para cambiar el estado del pedido
    Route::put('/api/pedidos/{id}/cambiar-estado', [PedidoController::class, 'cambiarEstado']);






    




    Route::get('/pedidos/actualizar', [PedidoController::class, 'obtenerPedidos']);







    // Ruta para almacenar los menus
    Route::get('/menu', [MenuItemController::class, 'index'])->name('menu.index');
    route::get('/nuevoplato', [MenuItemController::class, 'create'])->name('menu.nuevoplato');
    route::post('store', [MenuItemController::class, 'store'])->name('menu.store');
    route::get('menu/{id}', [MenuItemController::class, 'show'])->name('menu.show');
    route::get('menu/{id}/edit', [MenuItemController::class, 'edit'])->name('menu.edit');
    Route::put('menu/{id}', [MenuItemController::class, 'update'])->name('menu.update');
    route::delete('menu/{id}', [MenuItemController::class, 'destroy'])->name('menu.destroy');
});

// Rutas de perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/restaurantes/pay-fee', [RestauranteController::class, 'pay_fee'])->name('restaurantes.pay-fee');
    Route::post('/restaurantes/handlePayment', [PaymentController::class, 'handlePayment'])->name('handle.payment');
    Route::post('/checkout', [CheckoutController::class, 'createCheckoutSession'])->name('checkout.create');
    Route::get('/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

    Route::post('/categorias', [CategoryController::class, 'store'])->name('categorias.store');

    
    
    // Rutas para Pedidos
    
    
    // Rutas para Restaurantes
    Route::get('/restaurantes', [RestauranteController::class, 'index'])->name('restaurantes.index');
    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
    // Rutas para Repartidores
    Route::get('/repartidores', [RepartidorController::class, 'index'])->name('repartidores.index');

    //Rutas para editar restaurantes
    Route::get('/restaurantes/{id}/edit', [RestauranteController::class, 'edit'])->name('restaurantes.edit');
    Route::put('/restaurantes/{id}', [RestauranteController::class, 'update'])->name('restaurantes.update');

    // Ruta para mostrar los comentarios de un restaurante
    Route::get('/restaurantes/{id}/comentarios', [RestauranteController::class, 'showComentarios'])->name('restaurantes.comentarios');

});

//Rutas para aviso de privacidad y términos y condiciones
Route::get('/terminos', [LegalController::class, 'terminos'])->name('terminos');
Route::get('/aviso-privacidad', [LegalController::class, 'avisoPrivacidad'])->name('aviso_privacidad');

require __DIR__.'/auth.php';