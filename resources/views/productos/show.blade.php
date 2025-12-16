<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title>{{ $producto->nombre }} | Little Wonders</title>
    <link rel="icon" href="{{ asset('FotosPromocionales/logo.svg') }}" type="image/x-icon">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Paleta colores -->
    <style>
        .text-brand { color: #db2777; }
        .bg-brand { background-color: #db2777; }
        .btn-primary { background-color: #db2777; color: white; transition: 0.3s; }
        .btn-primary:hover { background-color: #be185d; }
    </style>
</head>

<body class="bg-gray-50 font-sans">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 grid grid-cols-3 items-center">
            
            <!-- Rollback -->
            <a href="javascript:history.back()"
            class="text-gray-500 hover:text-brand flex items-center gap-2 justify-self-start">
                <i class="fa-solid fa-arrow-left"></i> Volver a la tienda
            </a>

            <!-- Logo centrado -->
            <a href="{{ route('home') }}"
            class="text-2xl font-bold text-brand flex items-center gap-2 justify-self-center">
                <i class="fa-solid fa-baby-carriage"></i> Little Wonders
            </a>

            <!-- Usuario a la derecha -->
            <div class="relative justify-self-end" x-data="{ open: false }">
                @auth
                    <button
                        @click="open = !open"
                        class="flex items-center gap-2 text-gray-600 hover:text-brand transition focus:outline-none"
                    >
                        <i class="fa-solid fa-user"></i>
                        <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </button>

                    <div 
                        x-show="open"
                        @click.outside="open = false"
                        x-transition
                        class="absolute right-0 mt-2 w-44 bg-white border rounded-lg shadow-md z-50"
                    >
                        <a href="{{ route('User.show', Auth::id()) }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fa-solid fa-eye mr-2"></i> Ver Perfil
                        </a>

                        <a href="{{ route('User.edit', Auth::id()) }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fa-solid fa-pen mr-2"></i> Editar datos
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                <i class="fa-solid fa-right-from-bracket mr-2"></i> Cerrar sesión
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                    class="text-gray-600 hover:text-brand transition">
                        <i class="fa-solid fa-user text-xl"></i>
                    </a>
                @endauth
            </div>

        </div>
    </nav>




    <!-- Producto -->
    <main class="container mx-auto px-4 py-10">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2">
                
                <!-- Imagen -->
                <div class="bg-pink-50 h-96 md:h-full overflow-hidden">
                    <img src="{{ asset('ImagenesProductos/'. $producto->foto) }}" 
                        alt="{{ $producto->nombre }}" 
                        class="w-full h-full object-cover object-center">
                </div>

                <!-- Nombre -->
                <div class="p-8 md:p-12 flex flex-col justify-center">
                    <span class="text-pink-500 font-semibold tracking-wider text-sm uppercase mb-2">Maternidad</span>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $producto->nombre }}</h1>
                    
                    <!-- Precio -->
                    <div class="text-3xl font-bold text-gray-900 mb-6">
                        ${{ number_format($producto->precio, 0, ',', '.') }}
                    </div>
                    
                    <!-- Descripcion -->
                    <p class="text-gray-600 leading-relaxed mb-8">
                        {{ $producto->descripcion }}
                    </p>

                    <!-- Stock -->
                    <div class="border-t border-b border-gray-100 py-4 mb-8">
                        <div class="flex items-center gap-4">
                            <span class="text-gray-500">Disponibilidad:</span>
                            
                            @if($producto->stock)
                                @php
                                    $status = $producto->stock->stock_status;
                                    $quantity = $producto->stock->quantity;
                                @endphp
                                
                                @if($status == 'Disponible')
                                    <span class="text-green-600 font-medium flex items-center gap-1">
                                        <i class="fa-solid fa-check-circle"></i> 
                                        {{ $status }} ({{ $quantity }})
                                    </span>
                                @elseif($status == 'Bajo Stock')
                                    <span class="text-yellow-600 font-medium flex items-center gap-1">
                                        <i class="fa-solid fa-exclamation-triangle"></i>
                                        {{ $status }} ({{ $quantity }})
                                    </span>
                                @else
                                    <span class="text-red-500 font-medium flex items-center gap-1">
                                        <i class="fa-solid fa-times-circle"></i>
                                        {{ $status }}
                                    </span>
                                @endif
                            @else
                                <span class="text-gray-500 font-medium">No disponible</span>
                            @endif
                        </div>
                    </div>

                    <!-- Formulario "Agregar carrito" -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST" class="flex-1">
                            @csrf
                            
                            <button type="submit" 
                                class="w-full border-2 border-gray-200 text-gray-700 py-3 rounded-lg font-semibold hover:border-pink-500 hover:text-pink-500 transition flex items-center justify-center gap-2">
                                <i class="fa-solid fa-cart-plus"></i> Agregar al Carrito
                            </button>
                        </form>
                    </div>

                    <!-- Detalles de Servicio -->
                    <div class="mt-6 text-xs text-gray-400 text-center flex items-center justify-center gap-4">
                        <span><i class="fa-solid fa-shield-halved"></i> Compra Segura</span>
                        <span><i class="fa-solid fa-truck"></i> Envío Rápido</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Productos relacionados -->
        @if($relacionados->count() > 0)
        <div class="mt-16">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">También te podría gustar</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($relacionados as $rel)
                    <a href="{{ route('productos.show', $rel->id) }}" class="group block">
                        <div class="bg-white p-4 rounded-lg shadow-sm hover:shadow hover:scale-105 transition">
                            <div class="h-32 bg-gray-100 rounded mb-3 overflow-hidden">
                                <img src="{{ asset('storage/ImagenesProductos/' . $rel->foto )}}" class="w-full h-full object-cover">
                            </div>
                            <h4 class="font-medium text-gray-800 truncate">{{ $rel->nombre }}</h4>
                            <p class="text-brand font-bold text-sm">${{ number_format($rel->precio, 0, ',', '.') }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        @endif
    </main>
</body>
</html>