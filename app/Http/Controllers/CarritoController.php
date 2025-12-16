<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Session;

class CarritoController extends Controller
{
    /**
     * Muestra la vista del carrito de compras.
     */
    public function mostrarCarrito()
    {
        // Obtiene los items del carrito desde la sesión. Si no hay, devuelve un array vacío.
        $articulos = Session::get('carrito', []);

        // Inicializa el subtotal
        $subtotal = 0;

        // Calcula el subtotal total de todos los artículos
        foreach ($articulos as $articulo) {
            // El total de cada línea es (precio * cantidad)
            $subtotal += $articulo['precio'] * $articulo['cantidad'];
        }

        // Retorna la vista con los datos
        return view('carrito.show', [
            'articulos' => $articulos,
            'subtotal' => $subtotal,
        ]);
    }

    /**
     * Agrega un producto al carrito.
     */
    public function agregar(Request $request, $idProducto)
    {
        
        // 1. Busca el producto en la base de datos
        $producto = Producto::findOrFail($idProducto);

        // 2. Obtiene el carrito actual de la sesión (o un array vacío si no existe)
        $carrito = Session::get('carrito', []);

        // 3. Verifica si el producto ya está en el carrito
        if (isset($carrito[$idProducto])) {
            // Si ya está, incrementa la cantidad
            $carrito[$idProducto]['cantidad']++;
        } else {
            // Si no está, lo agrega con cantidad 1
            $carrito[$idProducto] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'foto' => $producto->foto, // Asume que la columna 'foto' tiene la ruta de la imagen
                'cantidad' => 1,
            ];
        }

        // 4. Guarda el carrito actualizado en la sesión
        Session::put('carrito', $carrito);

        // 5. Redirige o retorna una respuesta
        return redirect()->route('carrito.mostrar')->with('mensaje', 'Producto agregado al carrito.');
    }

    /**
     * Actualiza la cantidad de un producto en el carrito.
     */
    public function actualizar(Request $request, $id)
    {
        $carrito = session('carrito', []);

        if (!isset($carrito[$id])) {
            return response()->json(['error' => 'Producto no existe'], 404);
        }

        $cantidad = max(1, (int) $request->cantidad);
        $carrito[$id]['cantidad'] = $cantidad;

        session(['carrito' => $carrito]);

        // Recalcular subtotal real (backend)
        $subtotal = 0;
        foreach ($carrito as $item) {
            $subtotal += $item['precio'] * $item['cantidad'];
        }

        return response()->json([
            'ok' => true,
            'subtotal' => $subtotal
        ]);
    }


    /**
     * Elimina un producto del carrito.
     */
    public function eliminar($idProducto)
    {
        // Recuperar el carrito de la sesión.
        $carrito = Session::get('carrito', []);

        // Verificar si el producto existe antes de intentar eliminarlo.
        if (isset($carrito[$idProducto])) {
            unset($carrito[$idProducto]); // Eliminar el producto del array.
            Session::put('carrito', $carrito); // Guardar el carrito actualizado en la sesión.
        }

        // Devolver una respuesta JSON con el mensaje y el subtotal actualizado.
        return response()->json([
            'mensaje' => 'Producto eliminado del carrito.',
            'subtotal' => $this->calcularSubtotal($carrito) // Asegúrate de que este método exista
        ]);
    }


    private function calcularSubtotal(array $carrito): int
    {
        $subtotal = 0;
        foreach ($carrito as $item) {
            $subtotal += $item['precio'] * $item['cantidad'];
        }
        return $subtotal;
    }
}