<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/logo.svg') }}" type="image/x-icon">
    <title>Pedido Confirmado | Little Wonders</title>
    
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#fdf5f7] min-h-screen flex justify-center items-center p-4">

    <div class="bg-white w-full max-w-2xl rounded-xl shadow-lg p-8 border border-pink-200">
        
        <!-- Header de éxito -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-pink-500">¡Pedido Realizado con Éxito!</h1>
            <p class="text-gray-600 mt-2">Gracias por tu compra. Aquí tienes los detalles de tu pedido.</p>
        </div>

        <!-- Número del pedido -->
        <div class="mb-6">
            <p class="text-lg font-semibold text-gray-800">
                Número de Pedido: 
                <span class="text-pink-500">#{{ $order->id }}</span>
            </p>
            <p class="text-sm text-gray-500 mt-1">
                Estado: <span class="font-semibold text-green-600">{{ ucfirst($order->status) }}</span>
            </p>
        </div>

        <!-- Dirección -->
        <div class="bg-pink-50 border border-pink-200 rounded-lg p-4 mb-6">
            <h2 class="font-semibold text-gray-800 mb-2">Dirección de Entrega</h2>

            <p class="text-gray-700">
                {{ $order->address->full_address }}
            </p>
            <p class="text-gray-600 text-sm mt-1">
                {{ $order->address->contact_name }} - {{ $order->address->contact_phone }}
            </p>
        </div>

        <!-- Método de pago -->
        <div class="bg-pink-50 border border-pink-200 rounded-lg p-4 mb-6">
            <h2 class="font-semibold text-gray-800 mb-2">Método de Pago</h2>

            <p class="text-gray-700 capitalize">
                {{ str_replace('_', ' ', $order->payment_method) }}
            </p>
        </div>

        <!-- Lista de productos -->
        <div class="mb-6">
            <h2 class="font-semibold text-gray-800 mb-3">Productos del Pedido</h2>

            <div class="space-y-3">
                @foreach($order->products as $item)
                    <div class="flex justify-between bg-gray-50 rounded-lg p-3 border border-gray-200">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $item['product']->nombre }}</p>
                            <p class="text-sm text-gray-500">Cantidad: {{ $item['quantity'] }}</p>
                        </div>
                        <p class="font-semibold text-gray-700">
                            ${{ number_format($item['unit_price'], 0, ',', '.') }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Resumen de pago -->
        <div class="border-t border-gray-200 pt-4">
            <div class="flex justify-between text-gray-700 mb-1">
                <span>Subtotal:</span>
                <span>${{ number_format($order->subtotal, 0, ',', '.') }}</span>
            </div>

            <div class="flex justify-between text-gray-700 mb-1">
                <span>IVA:</span>
                <span>${{ number_format($order->tax, 0, ',', '.') }}</span>
            </div>

            <div class="flex justify-between text-gray-900 font-bold text-lg">
                <span>Total:</span>
                <span>${{ number_format($order->total, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Botones -->
        <div class="mt-8 text-center">
            <a href="{{ route('home') }}"
               class="bg-pink-500 hover:bg-pink-600 text-white py-2 px-6 rounded-full shadow-lg transition">
                Seguir Comprando
            </a>
        </div>

    </div>

</body>
</html>
