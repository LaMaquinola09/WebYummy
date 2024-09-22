<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\RepartidorDashboardController; // Asegúrate de crear este controlador
use App\Http\Controllers\RestauranteDashboardController; // Asegúrate de crear este controlador
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\RepartidorController;
use App\Http\Controllers\LegalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\MenuItemController;



Route::get('/', function () {
    return view('welcome');
});


Route::get('/notificacion', [SolicitudController::class, 'index'])->name('solicitudRestaurante.notificacion');

// Ruta para mostrar el formulario de registro de solicitud
Route::get('/registrosolicitud', [SolicitudController::class, 'create'])->name('Registrosolicitud');

// Ruta para almacenar la solicitud
Route::post('/solicitudes', [SolicitudController::class, 'store'])->name('solicitudes.store');



// Ruta para almacenar los menus
route::get('/menu', [MenuItemController::class, 'index'])->name('menu');








Route::put('/restaurant/{id}/update-status', [RestauranteController::class, 'updateStatus'])->name('restaurant.update.status');

// Ruta general del dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('adminDash');

// Rutas de perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    
    // Rutas para Pedidos
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos');
    
    // Rutas para Restaurantes
    
    // Rutas para Repartidores
    Route::get('/repartidores', [RepartidorController::class, 'index'])->name('drivers');
});

//Rutas para aviso de privacidad y términos y condiciones
Route::get('/terminos', [LegalController::class, 'terminos'])->name('terminos');
Route::get('/aviso-privacidad', [LegalController::class, 'avisoPrivacidad'])->name('aviso_privacidad');

require __DIR__.'/auth.php';
