<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Little Wonders | Maternidad y Amor</title>

    <!-- Si NO usas Vite, activa Tailwind por CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">


    <style>
        /* Paleta suave para maternidad */
        .bg-brand { background-color: #fce7f3; } /* Rosa suave */
        .text-brand { color: #db2777; }
        .btn-primary { background-color: #db2777; color: white; }
        .btn-primary:hover { background-color: #be185d; }
    </style>
</head>

<body class="bg-gray-50 font-sans">

    <!-- HEADER (Basado en tu foto de referencia) -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-brand flex items-center gap-2">
                <i class="fa-solid fa-baby-carriage"></i> Little Wonders
            </a>
            

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

            <div class="bg-white">
                <div class="container mx-auto px-4 py-3 overflow-x-auto whitespace-nowrap">
                    <a href="{{ route('home') }}" class="inline-block px-4 py-1 text-gray-600 hover:text-brand text-sm font-medium">Home</a>
                    <a href="?category=ropa" class="inline-block px-4 py-1 text-gray-600 hover:text-brand text-sm font-medium">Bebes</a>
                    <a href="?category=juguetes" class="inline-block px-4 py-1 text-gray-600 hover:text-brand text-sm font-medium">Juguetes y Estimulacion</a>
                    <a href="?category=lactancia" class="inline-block px-4 py-1 text-gray-600 hover:text-brand text-sm font-medium">Madres</a>
                </div>
            </div>

            <div class="flex items-center gap-4">
                {{-- Enlace al carrito de compras --}}
                <a href="{{ route('carrito.mostrar') }}" class="relative text-gray-600 hover:text-brand transition">
                    <i class="fa-solid fa-cart-shopping text-xl"></i>

                    {{-- Cantidad de productos --}}
                    <span class="absolute -top-2 -right-2 bg-pink-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                        {{ count(Session::get('carrito', [])) }}
                    </span>
                </a>

                {{-- Icono de usuario --}}
                <a href="{{ route('User') }}" class="text-gray-600 hover:text-brand transition">
                    <i class="fa-solid fa-user text-xl"></i>
                </a>
            </div>
        </div>
    </nav>


    <!-- HERO PRINCIPAL -->
    <section class="bg-white border-b py-12">
        <div class="container mx-auto flex flex-col md:flex-row items-center">

            <!-- Texto CTA -->
            <div class="w-full md:w-1/2 px-6 flex flex-col items-center text-center">
                <h1 class="text-4xl font-bold text-pink-600 leading-tight">
                    Bienvenida a Little Wonders
                </h1>

                <p class="text-gray-600 mt-4 text-lg">
                    Encuentra ropa, accesorios y artículos pensados con amor para tu bebé y maternidad.
                </p>

                <a href="{{ route('productos.index') }}"
                class="mt-6 inline-block bg-pink-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-pink-700 transition">
                    Ver catálogo
                </a>
            </div>


            <!-- Imagen principal -->
            <div class="w-full md:w-1/2 mt-10 md:mt-0 px-6">
                <img src="{{ asset('storage/FotosPromocionales/LlamadoAccionIndex.png') }}"
                    alt="Mamá con su bebé"
                    class="rounded-xl shadow-md w-[60%] mx-auto object-cover">
            </div>
        </div>
    </section>

    <!-- RECOMENDACIONES -->
    <section class="py-14 bg-gray-200">
        <div class="container mx-auto px-6">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-10">
                Recomendados para ti
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">

                @forelse ($productos as $producto)
                <div class="bg-white shadow-md rounded-lg p-4 hover:shadow-lg transition">
                    <img src="data:image/jpeg;base64,{{ $producto->foto }}" class="w-full h-56 object-cover rounded-lg" alt="{{ $producto->nombre }}">

                    <h3 class="mt-4 text-lg font-semibold text-gray-700">
                        {{ $producto->nombre }}
                    </h3>

                    <p class="text-gray-500 text-sm mt-1">
                        {{ Str::limit($producto->descripcion, 80) }}
                    </p>

                    <p class="mt-3 font-bold text-pink-600 text-lg">
                        ${{ number_format($producto->precio, 0, ',', '.') }}
                    </p>

                    <a href="{{ route('productos.show', $producto->id) }}"
                        class="mt-3 block text-center bg-pink-600 text-white py-2 rounded-lg hover:bg-pink-700 transition">
                        Ver producto
                    </a>
                </div>

                @empty
                <p class="text-center col-span-3 text-gray-500">
                    No hay productos disponibles aún.
                </p>
                @endforelse
            </div>
        </div>
    </section>

    <footer class="bg-white border-t mt-12 py-8 text-center text-gray-500 text-sm">
        <p>&copy; {{ date('Y') }} Little Wonders. Hecho con amor.</p>
    </footer>

</body>
</html>
