<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Finalizar Pago | Little Wonders</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .bg-brand { background-color: #fce7f3; }
        .text-brand { color: #db2777; }
        .btn-primary { background-color: #db2777; color: white; }
        .btn-primary:hover { background-color: #be185d; }
        .btn-secondary { background-color: #fce7f3; color: #db2777; }
        .btn-secondary:hover { background-color: #fbcfe8; }
    </style>
</head>

<body class="bg-gray-50">

    {{-- HEADER --}}
    <nav class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between relative">

            <!-- IZQUIERDA -->
            <a href="{{ route('carrito.mostrar') }}"
            class="text-gray-500 hover:text-brand flex items-center gap-2 z-20">
                <i class="fa-solid fa-arrow-left"></i> Volver al Carrito
            </a>

            <!-- LOGO CENTRADO -->
            <a href="{{ route('home') }}" 
            class="text-2xl font-bold text-brand flex items-center gap-2 absolute left-1/2 -translate-x-1/2">
                <i class="fa-solid fa-baby-carriage"></i> Little Wonders
            </a>

            <!-- DERECHA -->
            <a href="{{ route('User') }}" 
            class="text-gray-600 hover:text-brand transition flex items-center gap-2 z-20">
                @auth
                    <p>{{ Auth::user()->name }}</p>
                @else
                    <i class="fa-solid fa-user text-xl"></i>
                @endauth
            </a>

        </div>
    </nav>



    {{-- CONTENIDO --}}
    <main class="container mx-auto px-4 py-10">
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-xl p-6 md:p-10">

            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8 uppercase tracking-wider">
                FINALIZAR PAGO
            </h1>

            {{-- ERRORES --}}
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf

                {{-- DIRECCIÓN --}}
                <div class="mb-6">
                    <label class="block font-semibold text-gray-700 mb-2">
                        Dirección de envío *
                    </label>

                    {{-- SELECT DE DIRECCIONES --}}
                    <select id="direccion_select" name="direccion_select"
                        class="w-full border rounded-lg p-3 bg-gray-50 focus:outline-pink-300">
                        
                        <option value="">Selecciona una dirección...</option>

                        @foreach ($direcciones as $dir)
                            <option value="{{ $dir->id }}">
                                {{ $dir->full_address }}
                            </option>
                        @endforeach

                        <option value="nueva">➕ Agregar nueva dirección</option>
                    </select>

                    {{-- INPUT NUEVA DIRECCIÓN (OCULTO AL INICIO) --}}
                    <input type="text" name="direccion" id="direccion_input"
                        class="w-full border rounded-lg p-3 focus:outline-pink-300 bg-gray-50 mt-3 hidden"
                        placeholder="Ingresa tu nueva dirección…">
                </div>



                {{-- TELÉFONO --}}
                <div class="mb-6">
                    <label class="block font-semibold text-gray-700 mb-2">
                        Teléfono *
                    </label>
                    <input type="text" name="telefono"
                        class="w-full border rounded-lg p-3 focus:outline-pink-300 bg-gray-50"
                        placeholder="Ejemplo: 300 123 4567" required>
                </div>

                {{-- MÉTODO DE PAGO --}}
                <div class="mb-6">
                    <label class="block font-semibold text-gray-700 mb-2">
                        Método de Pago *
                    </label>

                    <select name="metodo_pago"
                        class="w-full border rounded-lg p-3 bg-gray-50 focus:outline-pink-300" required>
                        <option value="">Seleccionar método...</option>
                        <option value="tarjeta">💳 Tarjeta de crédito / débito</option>
                        <option value="nequi">📱 Nequi</option>
                        <option value="daviplata">📱 Daviplata</option>
                        <option value="contraentrega">🚚 Pago contraentrega</option>
                    </select>
                </div>

                <div class="bg-pink-50 border border-pink-200 rounded-lg p-4 mb-6">
                    <h2 class="font-semibold text-gray-800 mb-1">Resumen de pago</h2>

                    <p class="text-gray-700">Subtotal:</p>
                    <p class="text-brand font-bold text-xl">${{ number_format($subtotal, 0, ',', '.') }}</p>
                </div>


                {{-- BOTÓN --}}
                <button type="submit"
                    class="btn-primary w-full py-3 rounded-full font-semibold uppercase tracking-wider shadow-lg shadow-pink-200">
                    Confirmar Pedido
                </button>
            </form>

        </div>
    </main>



    {{-- FOOTER --}}
    <footer class="bg-white border-t mt-12 py-8 text-center text-gray-500 text-sm">
        <p>&copy; {{ date('Y') }} Little Wonders. Hecho con amor.</p>
    </footer>


    <script>
        document.getElementById("direccion_select").addEventListener("change", function () {
            let input = document.getElementById("direccion_input");

            if (this.value === "nueva") {
                input.classList.remove("hidden");
                input.required = true;
            } else {
                input.classList.add("hidden");
                input.required = false;
            }
        });
    </script>

</body>
</html>
