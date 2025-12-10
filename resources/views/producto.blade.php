<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Little Wonders | Maternidad y Amor</title>
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
                <button class="relative text-gray-600 hover:text-brand transition">
                    <i class="fa-solid fa-cart-shopping text-xl"></i>
                    <span class="absolute -top-2 -right-2 bg-pink-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">0</span>
                </button>
            </div>
        </div>
    </nav>

    

    <main class="container mx-auto px-4 py-8">
        
        @if(request('search'))
            <h2 class="text-xl text-gray-700 mb-6">Resultados para: <span class="font-bold">"{{ request('search') }}"</span></h2>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($productos as $producto)
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden group border border-gray-100">
                <div class="relative h-64 overflow-hidden bg-gray-100">
                    <img src="data:image/jpeg;base64,{{ $producto->foto }}" alt="Producto" 
                        class="w-full h-full object-cover object-center group-hover:scale-105 transition duration-500">
                    @if($producto->stock)
                        @php
                            $status = $producto->stock->stock_status;
                            $quantity = $producto->stock->quantity;
                        @endphp
                        
                        @if($status == 'Disponible')
                            <span class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">
                                <i class="fa-solid fa-check-circle"></i> 
                                {{ $status }} ({{ $quantity }})
                            </span>
                        @elseif($status == 'Bajo Stock')
                            <span class="absolute top-2 left-2 bg-yellow-500 text-white text-xs px-2 py-1 rounded">
                                <i class="fa-solid fa-exclamation-triangle"></i>
                                {{ $status }} ({{ $quantity }})
                            </span>
                        @else
                            <span class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded">
                                <i class="fa-solid fa-times-circle"></i>
                                {{ $status }}
                            </span>
                        @endif
                    @else
                        <span class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded">No disponible</span>
                    @endif
                </div>

                <div class="p-4">
                    <p class="text-lg font-medium text-gray-800 truncate">{{ $producto->nombre }}</p>
                    <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $producto->descripcion }}</p>
                    
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-xl font-bold text-gray-900">${{ number_format($producto->precio, 0, ',', '.') }}</span>
                        <a href="{{ route('productos.show', $producto->id) }}" class="text-brand text-sm font-medium hover:underline">
                            Ver detalle
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-20">
                <i class="fa-regular fa-face-sad-tear text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">No encontramos productos con esa descripción.</p>
                <a href="{{ route('productos.index') }}" class="text-brand font-bold mt-2 inline-block">Ver todo el catálogo</a>
            </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $productos->links() }}
        </div>
    </main>

    <footer class="bg-white border-t mt-12 py-8 text-center text-gray-500 text-sm">
        <p>&copy; {{ date('Y') }} Little Wonders. Hecho con amor.</p>
    </footer>

</body>
</html>