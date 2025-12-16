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
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $carrito = session('carrito', []);
        $subtotal = 0;

        foreach ($carrito as $item) {
            $subtotal += $item['precio'] * $item['cantidad'];
        }

        $direcciones = auth()->user()->addresses()->get();

        return view('CheckoutPay.index', compact(
            'direcciones',
            'carrito',
            'subtotal'
        ));
    }


    public function store(Request $request)
    {
        
        $request->validate([
            'direccion_select' => 'required',
            'telefono'         => 'required',
            'metodo_pago'      => 'required'
        ]);

        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return redirect()
                ->route('carrito.mostrar')
                ->with('mensaje', 'Tu carrito está vacío');
        }

        /*
        |--------------------------------------------------------------------------
        | 1️⃣ Resolver dirección seleccionada
        |--------------------------------------------------------------------------
        */

        if ($request->direccion_select === 'nueva') {

            $direccion = Address::create([
                'user_id'       => auth()->id(),
                'contact_name'  => auth()->user()->name,
                'contact_phone' => $request->telefono,
                'address'       => $request->direccion,
                'city'          => 'Sin definir',
                'department'    => 'Sin definir',
                'reference'     => null,
            ]);

            $address_id = $direccion->id;

        } else {

            // Validar que la dirección pertenezca al usuario
            $address = Address::where('id', $request->direccion_select)
                ->where('user_id', auth()->id())
                ->firstOrFail();

            $address_id = $address->id;
        }

        /*
        |--------------------------------------------------------------------------
        | 2️⃣ Calcular totales
        |--------------------------------------------------------------------------
        */

        $subtotal = 0;
        foreach ($carrito as $item) {
            $subtotal += $item['precio'] * $item['cantidad'];
        }

        $tax = $subtotal * 0.19;
        $total = $subtotal + $tax;

        /*
        |--------------------------------------------------------------------------
        | 3️⃣ Crear orden
        |--------------------------------------------------------------------------
        */

        $order = Order::create([
            'user_id'        => auth()->id(),
            'address_id'     => $address_id,
            'status'         => 'pendiente',
            'subtotal'       => $subtotal,
            'tax'            => $tax,
            'total'          => $total,
            'payment_method' => $request->metodo_pago,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 4️⃣ Guardar detalles de la orden
        |--------------------------------------------------------------------------
        */

        foreach ($carrito as $item) {
            OrderDetail::create([
                'order_id'   => $order->id,
                'producto_id'=> $item['id'],
                'quantity'   => $item['cantidad'],
                'unit_price' => $item['precio'],
                'subtotal'   => $item['precio'] * $item['cantidad'],
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | 5️⃣ Vaciar carrito
        |--------------------------------------------------------------------------
        */

        session()->forget('carrito');

        /*
        |--------------------------------------------------------------------------
        | 6️⃣ Redirigir a comprobante
        |--------------------------------------------------------------------------
        */

        return redirect()->route('orders.success', $order->id);
    }
}
