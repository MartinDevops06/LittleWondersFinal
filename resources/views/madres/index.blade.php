<?php 
    session_start();
    $usuario = $_SESSION['username'] ?? false;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bebés | Little Wonders</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .bg-brand { background-color: #fce7f3; }
        .text-brand { color: #db2777; }
        .btn-primary { background-color: #db2777; color: white; }
        .btn-primary:hover { background-color: #be185d; }
        html { scroll-behavior: smooth; }
    </style>
</head>

<body class="bg-gray-50 font-sans">

    <!-- NAVBAR -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            
            <!-- Logo -->
            <a href="{{ route('home') }}" class="text-2xl font-bold text-brand flex items-center gap-2">
                <i class="fa-solid fa-baby-carriage"></i> Little Wonders
            </a>
            
            <!-- Buscador -->
            <div class="hidden md:flex flex-1 mx-10">
                <form action="{{ route('productos.index') }}" method="GET" class="w-full relative">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Buscar ropita, accesorios..." 
                           class="w-full pl-4 pr-10 py-2 rounded-full border border-gray-200 focus:outline-none focus:border-pink-400 bg-gray-50">
                    <button type="submit" class="absolute right-3 top-2.5 text-gray-400 hover:text-pink-500">
                        <i class="fa-solid fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- MENÚ SUPERIOR -->
            <div class="flex gap-6 items-center">

                <a href="{{ route('home') }}" class="text-gray-600 hover:text-brand text-sm font-medium">
                    Home
                </a>

                <!-- BEBÉS (Hover con delay) -->
                <div 
                    x-data="{ open:false, timer:null }"
                    @mouseenter="clearTimeout(timer); open = true"
                    @mouseleave="timer = setTimeout(() => open = false, 400)"
                    class="relative"
                >
                    <a href="{{ route('bebes.index') }}" 
                    class="text-gray-600 hover:text-brand text-sm font-medium">
                        Bebés
                    </a>

                    <div 
                        x-show="open"
                        x-transition
                        class="absolute bg-white shadow-md rounded-lg mt-2 w-40 py-2 z-50"
                    >
                        <a href="{{ route('bebes.index') }}#ropa-bebe" class="block px-4 py-2 hover:bg-gray-100">
                            Ropa Bebé
                        </a>

                        <a href="{{ route('bebes.index') }}#alimentacion" class="block px-4 py-2 hover:bg-gray-100">
                            Alimentación
                        </a>

                        <a href="{{ route('bebes.index') }}#higiene" class="block px-4 py-2 hover:bg-gray-100">
                            Higiene
                        </a>
                    </div>
                </div>

                <!-- Juguetes -->
                <div 
                    x-data="{ open:false, timer:null }"
                    @mouseenter="clearTimeout(timer); open = true"
                    @mouseleave="timer = setTimeout(() => open = false, 400)"
                    class="relative"
                >
                    <a href="{{ route('juguetes.index') }}" 
                    class="text-gray-600 hover:text-brand text-sm font-medium">
                        Juguetes
                    </a>

                    <div 
                        x-show="open"
                        x-transition
                        class="absolute bg-white shadow-md rounded-lg mt-2 w-40 py-2 z-50"
                    >
                        <a href="{{ route('juguetes.index') }}#estimulación" 
                        class="block px-4 py-2 hover:bg-gray-100">
                            Estimulación
                        </a>

                        <a href="{{ route('juguetes.index') }}#motricidad" 
                        class="block px-4 py-2 hover:bg-gray-100">
                            Motricidad
                        </a>

                        <a href="{{ route('juguetes.index') }}#entretenimiento" 
                        class="block px-4 py-2 hover:bg-gray-100">
                            Entretenimiento
                        </a>
                    </div>
                </div>

                <!-- Madres -->
 <div 
                    x-data="{ open:false, timer:null }"
                    @mouseenter="clearTimeout(timer); open = true"
                    @mouseleave="timer = setTimeout(() => open = false, 400)"
                    class="relative"
                >
                    <a href="{{ route('madres.index') }}" 
                    class="text-gray-600 hover:text-brand text-sm font-medium">
                        Madres
                    </a>

                    <div 
                        x-show="open"
                        x-transition
                        class="absolute bg-white shadow-md rounded-lg mt-2 w-40 py-2 z-50"
                    >
                        <a href="{{ route('madres.index') }}#confort" 
                        class="block px-4 py-2 hover:bg-gray-100">
                            Confort
                        </a>

                        <a href="{{ route('madres.index') }}#salud" 
                        class="block px-4 py-2 hover:bg-gray-100">
                            Salud
                        </a>

                        <a href="{{ route('madres.index') }}#vestimenta" 
                        class="block px-4 py-2 hover:bg-gray-100">
                            Vestimenta
                        </a>
                    </div>
                </div>
            </div>

            <!-- ICONOS DERECHA -->
            <div class="flex items-center gap-4">

                <!-- Carrito -->
                <a href="{{ route('carrito.mostrar') }}" class="relative text-gray-600 hover:text-brand transition">
                    <i class="fa-solid fa-cart-shopping text-xl"></i>
                    <span class="absolute -top-2 -right-2 bg-pink-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                        {{ count(Session::get('carrito', [])) }}
                    </span>
                </a>

                <!-- Usuario -->
                <a href="{{ route('User') }}" class="text-gray-600 hover:text-brand transition">
                    @if ($usuario)
                        <p>{{ $_SESSION['username'] }}</p>
                    @else
                        <i class="fa-solid fa-user text-xl"></i>
                    @endif
                </a>

            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="bg-white border-b py-12">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl font-bold text-pink-600">Categorías Bebés</h1>
            <p class="text-gray-600 mt-3 text-lg">Todo lo que tu bebé necesita, organizado por secciones</p>
        </div>
    </section>

    <!-- CONTENIDO -->
<main class="container mx-auto px-6 py-10">

    <!-- ========================== -->
    <!-- 🔹 CONFORT -->
    <!-- ========================== -->
    <section id="confort" class="py-12 scroll-mt-24">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Confort</h2>

        @include('madres.secciones.confort')
    </section>

    <!-- ========================== -->
    <!-- 🔹 SALUD -->
    <!-- ========================== -->
    <section id="salud" class="py-12 scroll-mt-24">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Salud</h2>

        @include('madres.secciones.salud')
    </section>

    <!-- ========================== -->
    <!-- 🔹 Vestimenta -->
    <!-- ========================== -->
    <section id="vestimenta" class="py-12 scroll-mt-24">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Vestimenta</h2>

        @include('madres.secciones.vestimenta')
    </section>

</main>

    <footer class="bg-white border-t mt-12 py-8 text-center text-gray-500 text-sm">
        <p>&copy; {{ date('Y') }} Little Wonders. Hecho con amor.</p>
    </footer>

</body>
</html>
