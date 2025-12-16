<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <link rel="icon" href="{{ asset('FotosPromocionales/logo.svg') }}" type="image/x-icon">
    <title>Finalizar Pago | Little Wonders</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!--Paleta colores-->
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

    <!-- Header -->
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
            
            <!--Usuario-->
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
                        <a href="{{ route('User.show', Auth::id()) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fa-solid fa-eye mr-2"></i> Ver Perfil
                        </a>

                        <!-- Editar datos -->
                        <a href="{{ route('User.edit', Auth::id()) }}"class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
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



    <!-- Contenido -->
    <main class="container mx-auto px-4 py-10">
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-xl p-6 md:p-10">

            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8 uppercase tracking-wider">
                FINALIZAR PAGO
            </h1>

            <!-- Errores -->
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

                <!-- Direccion -->
                <div class="flex gap-2 items-start">

                    <!-- Desplegable select -->
                    <select id="direccion_select" name="direccion_select"
                        class="w-full border rounded-lg p-3 bg-gray-50 focus:outline-pink-300">
                        
                        <option value="">Selecciona una dirección...</option>

                        @foreach ($direcciones as $dir)
                            <option value="{{ $dir->id }}">
                                {{ $dir->full_address }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Agregar boton -->
                    <a href="{{ route('address.index', ['redirect' => url()->current()]) }}"
                    class="btn-secondary px-4 py-3 rounded-lg whitespace-nowrap text-sm font-semibold">
                        + Agregar
                    </a>
                </div>




                <!-- Telefono de contacto -->
                <div class="mb-6">
                    <label class="block font-semibold text-gray-700 mb-2">
                        Teléfono *
                    </label>
                    <input type="text" name="telefono"
                        class="w-full border rounded-lg p-3 focus:outline-pink-300 bg-gray-50"
                    placeholder="Ejemplo: 300 123 4567" required>
                </div>

                <!-- Metodo Pago -->
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


                <!-- Confirmar pedido -->
                <button type="submit"
                    class="btn-primary w-full py-3 rounded-full font-semibold uppercase tracking-wider shadow-lg shadow-pink-200">
                    Confirmar Pedido
                </button>
            </form>

        </div>
    </main>

    <footer class="bg-white border-t mt-12 py-8 text-center text-gray-500 text-sm">
        <p>&copy; {{ date('Y') }} Little Wonders. Hecho con amor.</p>
    </footer>
</body>
</html>
