<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\BebesController;
use App\Http\Controllers\JuguetesController;
use App\Http\Controllers\MadresController;

use App\Models\Order;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| PRODUCTOS
|--------------------------------------------------------------------------
*/
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/producto/{id}', [ProductoController::class, 'show'])->name('productos.show');

/*
|--------------------------------------------------------------------------
| CATEGORÍAS
|--------------------------------------------------------------------------
*/
Route::get('/bebes', [BebesController::class, 'index'])->name('bebes.index');
Route::get('/juguetes', [JuguetesController::class, 'index'])->name('juguetes.index');
Route::get('/madres', [MadresController::class, 'index'])->name('madres.index');

/*
|--------------------------------------------------------------------------
| CARRITO
|--------------------------------------------------------------------------
*/
Route::get('/carrito', [CarritoController::class, 'mostrarCarrito'])->name('carrito.mostrar');
Route::post('/carrito/agregar/{idProducto}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::patch('/carrito/actualizar/{idProducto}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::delete('/carrito/eliminar/{idProducto}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');

/*
|--------------------------------------------------------------------------
| AUTENTICACIÓN
|--------------------------------------------------------------------------
*/
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.post');

Route::get('/register', [UserController::class, 'create'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register.store');

Route::post('/logout', [UserController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| PERFIL (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [UserController::class, 'show'])
        ->name('User.show');

    Route::get('/profile/edit', [UserController::class, 'edit'])
        ->name('User.edit');

    Route::put('/profile', [UserController::class, 'update'])
        ->name('User.update');
});

/*
|--------------------------------------------------------------------------
| DIRECCIONES (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/address', [AddressController::class, 'index'])->name('address.index');
    Route::post('/address', [AddressController::class, 'store'])->name('address.store');
    Route::delete('/address/{id}', [AddressController::class, 'destroy'])->name('address.destroy');
});

/*
|--------------------------------------------------------------------------
| CHECKOUT (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});

/*
|--------------------------------------------------------------------------
| ORDEN COMPLETADA
|--------------------------------------------------------------------------
*/
Route::get('/order/success/{id}', function ($id) {
    $order = Order::findOrFail($id);
    return view('CheckoutPay.success', compact('order'));
})->name('orders.success');
