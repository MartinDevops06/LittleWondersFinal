<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Address;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $carrito = session('carrito', []);
        $subtotal = 0;

        foreach ($carrito as $item) {
            $subtotal += $item['precio'] * $item['cantidad'];
        }

        // Obtener direcciones del usuario
        $direcciones = Address::where('user_id', auth()->id())->get();

        return view('checkoutPay.index', compact('direcciones', 'carrito', 'subtotal'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'direccion_select' => 'required',
            'telefono' => 'required',
            'metodo_pago' => 'required'
        ]);

        $carrito = session('carrito', []);
        if (empty($carrito)) {
            return redirect()->route('carrito.mostrar')
                ->with('mensaje', 'Tu carrito está vacío');
        }

        /**
         * 1️⃣ Resolver dirección
         */
        if ($request->direccion_select === "nueva") {
            $direccion = Address::create([
                'user_id' => auth()->id(),
                'contact_name' => auth()->user()->name,
                'contact_phone' => $request->telefono,
                'address' => $request->direccion,
                'city' => 'Sin definir',
                'department' => 'Sin definir',
                'reference' => ''
            ]);
            $address_id = $direccion->id;
        } else {
            // Buscar dirección seleccionada por ID
            $address_id = Address::findOrFail($request->direccion_select)->id;
        }

        /**
         * 2️⃣ Calcular totales
         */
        $subtotal = 0;
        foreach ($carrito as $item) {
            $subtotal += $item['precio'] * $item['cantidad'];
        }

        $tax = $subtotal * 0.19;
        $total = $subtotal + $tax;

        /**
         * 3️⃣ Crear orden
         */
        $order = Order::create([
            'user_id' => auth()->id(),
            'address_id' => $address_id,
            'status' => 'pendiente',
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'payment_method' => $request->metodo_pago,
        ]);

        /**
         * 4️⃣ Guardar detalles de la orden
         */
        foreach ($carrito as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'producto_id' => $item['id'],
                'quantity' => $item['cantidad'],
                'unit_price' => $item['precio'],
                'subtotal' =>$subtotal
            ]);
        }

        /**
         * 5️⃣ Vaciar carrito
         */
        session()->forget('carrito');

        /**
         * 6️⃣ Redirigir a pantalla de comprobante
         */
        return redirect()->route('orders.success', $order->id);
    }
}
