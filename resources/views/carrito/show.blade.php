<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tu Carrito de Compras | Little Wonders</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Alpine.js (NECESARIO PARA LOS DROPDOWNS) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .bg-brand { background-color: #fce7f3; }
        .text-brand { color: #db2777; }
        .btn-primary { background-color: #db2777; color: white; }
        .btn-primary:hover { background-color: #be185d; }
        .btn-secondary { background-color: #fce7f3; color: #db2777; }
        .btn-secondary:hover { background-color: #fbcfe8; }
        .tabla-carrito th { background-color: #fce7f3; color: #db2777; padding: 1rem 0; }
    </style>
</head>

<body class="bg-gray-50 font-sans">

    {{-- HEADER --}}
    <nav class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between relative">

            <!-- IZQUIERDA -->
            <a href="javascript:history.back()" 
            class="text-gray-500 hover:text-brand flex items-center gap-2 z-20">
                <i class="fa-solid fa-arrow-left"></i> Volver a la tienda
            </a>

            <!-- LOGO CENTRADO -->
            <a href="{{ route('home') }}" 
            class="text-2xl font-bold text-brand flex items-center gap-2 absolute left-1/2 -translate-x-1/2">
                <i class="fa-solid fa-baby-carriage"></i> Little Wonders
            </a>

            <div class="relative" x-data="{ open: false }">
                @auth
                    <!-- Botón usuario -->
                    <button 
                        @click="open = !open"
                        class="flex items-center gap-2 text-gray-600 hover:text-brand transition focus:outline-none"
                    >
                        <i class="fa-solid fa-user"></i>
                        <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </button>

                    <!-- Dropdown -->
                    <div 
                        x-show="open"
                        @click.outside="open = false"
                        x-transition
                        class="absolute right-0 mt-2 w-44 bg-white border rounded-lg shadow-md z-50"
                    >
                        <a 
                            href="{{ route('User.show', Auth::id()) }}" 
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        >
                            <i class="fa-solid fa-eye mr-2"></i> Ver Perfil
                        </a>
                        <!-- Editar datos -->
                        <a 
                            href="{{ route('User.edit', Auth::id()) }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        >
                            <i class="fa-solid fa-pen mr-2"></i> Editar datos
                        </a>

                        <!-- Cerrar sesión -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button 
                                type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
                            >
                                <i class="fa-solid fa-right-from-bracket mr-2"></i> Cerrar sesión
                            </button>
                        </form>
                    </div>
                @else
                    <!-- Usuario no autenticado -->
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-brand transition">
                        <i class="fa-solid fa-user text-xl"></i>
                    </a>
                @endauth
            </div>
        </div>
</nav>


    {{-- CONTENIDO --}}
    <main class="container mx-auto px-4 py-10">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-xl p-6 md:p-10">

            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8 uppercase tracking-wider">
                TU CARRITO DE COMPRAS
            </h1>

            {{-- MENSAJE --}}
            @if(session('mensaje'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    <span>{{ session('mensaje') }}</span>
                </div>
            @endif


            {{-- CARRITO VACÍO --}}
            @if(empty($articulos))
                <div class="text-center py-10">
                    <i class="fa-solid fa-box-open text-6xl text-gray-300"></i>
                    <p class="text-xl text-gray-600 mt-4">Tu carrito está vacío. ¡Es hora de llenarlo de maravillas!</p>

                    <a href="{{ route('home') }}" class="mt-6 inline-block btn-primary px-6 py-3 rounded-full font-semibold">
                        Ir a Comprar
                    </a>
                </div>
            

            {{-- CARRITO LLENO --}}
            @else

                {{-- TABLA --}}
                <table class="w-full text-left tabla-carrito">
                    <thead>
                        <tr class="border-b border-pink-200">
                            <th class="w-10"></th>
                            <th class="w-1/2">PRODUCTO</th>
                            <th class="w-1/6">PRECIO</th>
                            <th class="w-1/6 text-center">CANTIDAD</th>
                            <th class="w-1/6 text-right">TOTAL</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($articulos as $id => $articulo)

                        <tr class="border-b border-gray-100">

                            {{-- ELIMINAR --}}
                            <td class="py-4 align-top">
                                <form action="{{ route('carrito.eliminar', $articulo['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 transition" title="Eliminar">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </button>
                                </form>
                            </td>

                            {{-- PRODUCTO --}}
                            <td class="py-4">
                                <div class="flex items-start gap-4">
                                    <img src="{{ asset('storage/ImagenesProductos/' . $articulo['foto']) }}" 
                                        alt="{{ $articulo['nombre'] }}" 
                                        class="w-16 h-16 object-cover rounded-md border border-gray-100">

                                    <div class="flex flex-col">
                                        <span class="font-medium text-gray-800">{{ $articulo['nombre'] }}</span>
                                        <span class="text-sm text-gray-500">ID: {{ $articulo['id'] }}</span>
                                    </div>
                                </div>
                            </td>

                            {{-- PRECIO --}}
                            <td class="py-4 text-gray-700 font-medium">
                                ${{ number_format($articulo['precio'], 0, ',', '.') }}
                            </td>

                            {{-- CANTIDAD --}}
                            <td class="py-4 text-center">
                                <div class="flex items-center justify-center">

                                    <button class="decrement bg-gray-100 text-gray-600 w-8 h-8 rounded-l hover:bg-gray-200 transition">-</button>

                                    <input type="number" 
                                        id="cantidad-{{ $articulo['id'] }}" 
                                        value="{{ $articulo['cantidad'] }}" 
                                        min="1"
                                        class="w-10 h-8 text-center border border-gray-300 focus:outline-none text-gray-800" 
                                        readonly>

                                    <button class="increment bg-gray-100 text-gray-600 w-8 h-8 rounded-r hover:bg-gray-200 transition">+</button>

                                </div>
                            </td>

                            {{-- TOTAL POR FILA --}}
                            <td id="total-fila-{{ $articulo['id'] }}" 
                                class="py-4 text-right font-bold text-pink-600">
                                ${{ number_format($articulo['precio'] * $articulo['cantidad'], 0, ',', '.') }}
                            </td>

                            {{-- PRECIO OCULTO --}}
                            <input type="hidden" id="precio-{{ $articulo['id'] }}" value="{{ $articulo['precio'] }}">

                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{-- SUBTOTAL --}}
                <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
                    <div class="w-full md:w-2/5">
                        <div class="flex justify-between items-center text-xl font-bold mb-6">
                            <span>SUBTOTAL:</span>
                            <span id="subtotal" class="text-brand">
                                ${{ number_format($subtotal, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- ACCIONES --}}
                <div class="flex flex-col gap-3 mt-6">
                    <a href="{{ route('checkout.index') }}">
                        <button class="btn-primary w-full py-3 rounded-full font-semibold uppercase tracking-wider shadow-lg shadow-pink-200">
                            IR A PAGAR
                        </button>
                    </a>

                    <a href="{{ route('home') }}" class="text-center">
                        <button class="btn-secondary w-full py-3 rounded-full font-semibold uppercase tracking-wider hover:shadow">
                            SEGUIR COMPRANDO
                        </button>
                    </a>
                </div>

            @endif
        </div>
    </main>

    <footer class="bg-white border-t mt-12 py-8 text-center text-gray-500 text-sm">
        <p>&copy; {{ date('Y') }} Little Wonders. Hecho con amor.</p>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            function formatear(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            // Delegación de eventos (un solo listener para todos)
            document.body.addEventListener("click", async (e) => {

                // BOTÓN +
                if (e.target.closest(".increment")) {
                    const row = e.target.closest("tr");
                    actualizarCantidad(row, +1);
                }

                // BOTÓN -
                if (e.target.closest(".decrement")) {
                    const row = e.target.closest("tr");
                    actualizarCantidad(row, -1);
                }
            });

            async function actualizarCantidad(row, cambio) {
                const input = row.querySelector("input[id^='cantidad-']");
                const id = input.id.split("-")[1];
                const precio = parseInt(document.getElementById(`precio-${id}`).value);

                let cantidad = parseInt(input.value) + cambio;
                if (cantidad < 1) cantidad = 1;

                input.value = cantidad;

                // Actualiza total por fila
                const totalFila = cantidad * precio;
                document.getElementById(`total-fila-${id}`).textContent = "$" + formatear(totalFila);

                // Envía actualización al servidor
                const respuesta = await fetch(`/carrito/actualizar/${id}`, {
                    method: "PATCH",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ cantidad })
                });

                const data = await respuesta.json();

                // Actualiza subtotal
                if (data.subtotal !== undefined) {
                    document.getElementById("subtotal").textContent = "$" + formatear(data.subtotal);
                }
            }

        });
    </script>


</body>
</html>
