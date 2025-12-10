<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AddressController;


    /*
    |--------------------------------------------------------------------------
    | RUTAS DEL FRONT OFFICE (PRODUCTOS)
    |--------------------------------------------------------------------------
    */

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::controller(ProductoController::class)->group(function () {
        Route::get('producto/', 'index')->name('productos.index');
        Route::get('/producto/{id}', 'show')->name('productos.show');
        Route::get('/bebes', function () {
            return view('bebes.index');
        })->name('bebes.index');
        Route::get('/juguetes', function () {
            return view('juguetes.index');
        })->name('juguetes.index');
        Route::get('/madres', function () {
            return view('madres.index');
        })->name('madres.index');


    });


    /*
    |--------------------------------------------------------------------------
    | RUTAS DEL CARRITO DE COMPRAS
    |--------------------------------------------------------------------------
    */

    // Muestra la página principal del carrito
        Route::get('carrito', [CarritoController::class, 'mostrarCarrito'])->name('carrito.mostrar');

        // Agrega un producto al carrito
        Route::post('carrito/agregar/{idProducto}', [CarritoController::class, 'agregar'])->name('carrito.agregar');

        // Actualiza la cantidad (usando PUT o PATCH)
        Route::patch('carrito/actualizar/{idProducto}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');

        // Elimina un producto
        Route::delete('carrito/eliminar/{idProducto}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');

    /*
    |--------------------------------------------------------------------------
    | RUTAS DE login y register
    |--------------------------------------------------------------------------
    */

    Route::controller(UserController::class)->group(function () {
    Route::get('/user', 'index')->name('User');
    Route::get('/user/register', 'create')->name('registerUser');
    Route::post('/user/store', 'store')->name('storeUser');
    });



Route::get('/user/address', [AddressController::class, 'index'])->name('address');
Route::post('/direccion', [AddressController::class, 'store'])->name('address.store');

    /*
    |--------------------------------------------------------------------------
    | Autenticacion
    |--------------------------------------------------------------------------
    */
    Route::post('/login', [AuthController::class, 'login'])->name('login');
