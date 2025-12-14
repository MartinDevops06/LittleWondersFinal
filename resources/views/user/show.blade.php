@php
    // Estas variables deben ser pasadas desde el controlador:
    // $user
    // $address
    
    // Si el controlador no pasa $address y el usuario no tiene una, la creamos como null para evitar errores.
    if (!isset($address)) {
        $address = null;
    }
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Little Wonders | Mi Perfil</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .bg-brand { background-color: #fce7f3; }
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

            <div class="flex gap-6 items-center">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-brand text-sm font-medium">Home</a>
                </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('carrito.mostrar') }}" class="relative text-gray-600 hover:text-brand transition">
                    <i class="fa-solid fa-cart-shopping text-xl"></i>
                    <span class="absolute -top-2 -right-2 bg-pink-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                        {{ count(Session::get('carrito', [])) }}
                    </span>
                </a>

                <div class="relative" x-data="{ open: false }">
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
                            <a 
                                href="{{ route('User.show', Auth::id()) }}" 
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 font-bold"
                            >
                                <i class="fa-solid fa-eye mr-2"></i> Mi Perfil (Aquí)
                            </a>
                            <a 
                                href="{{ route('User.edit', Auth::id()) }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            >
                                <i class="fa-solid fa-pen mr-2"></i> Editar datos
                            </a>

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
                        <a href="{{ route('User') }}" class="text-gray-600 hover:text-brand transition">
                            <i class="fa-solid fa-user text-xl"></i>
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </nav>
    
    <main class="container mx-auto px-4 py-10 min-h-screen">
        @if(session('success'))
            <div class="max-w-4xl mx-auto p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold text-center text-brand mb-8 flex items-center justify-center">
                <i class="fa-solid fa-id-card-clip mr-3"></i> Información de Mi Perfil
            </h1>

            <div class="bg-white shadow-xl rounded-xl p-8 border border-gray-100 divide-y divide-gray-200">

                <section class="pb-6">
                    <div class="flex items-center text-2xl font-semibold text-gray-700 mb-6 border-b pb-2">
                        <i class="fa-solid fa-user-circle mr-3 text-pink-500"></i> Datos Personales
                        
                        {{-- Botón para ir a la edición --}}
                        <a href="{{ route('User.edit', $user->id) }}" class="ml-auto text-sm btn-primary px-4 py-1 rounded-full font-normal">
                            <i class="fa-solid fa-pen mr-1"></i> Editar
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 text-gray-700">
                        
                        {{-- Fila 1: Nombre Completo --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nombre Completo</p>
                            <p class="text-lg font-semibold">{{ $user->name }} {{ $user->last_name }}</p>
                        </div>

                        {{-- Fila 2: Correo Electrónico --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500">Correo Electrónico</p>
                            <p class="text-lg">{{ $user->email }}</p>
                        </div>

                        {{-- Fila 3: Teléfono --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500">Teléfono</p>
                            <p class="text-lg">{{ $user->phone ?? 'N/A' }}</p>
                        </div>

                        {{-- Fila 4: Fecha de Nacimiento --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500">Fecha de Nacimiento</p>
                            <p class="text-lg">
                                {{ $user->birth_date ? $user->birth_date->format('d/m/Y') : 'No especificada' }}
                            </p>
                        </div>
                    </div>
                </section>

                <section class="pt-6">
                    <div class="flex items-center text-2xl font-semibold text-gray-700 mb-6 border-b pb-2">
                        <i class="fa-solid fa-house-chimney mr-3 text-pink-500"></i> Dirección Principal
                    </div>

                    @if ($address)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 text-gray-700">
                            
                            {{-- Fila 1: Contacto --}}
                            <div>
                                <p class="text-sm font-medium text-gray-500">Contacto</p>
                                <p class="text-lg font-semibold">{{ $address->contact_name }} ({{ $address->contact_phone }})</p>
                            </div>

                            {{-- Fila 2: Ciudad y Departamento --}}
                            <div>
                                <p class="text-sm font-medium text-gray-500">Ubicación</p>
                                <p class="text-lg">{{ $address->city }}, {{ $address->department }}</p>
                            </div>

                            {{-- Fila 3: Dirección Completa --}}
                            <div class="md:col-span-2">
                                <p class="text-sm font-medium text-gray-500">Dirección Completa</p>
                                <p class="text-lg font-bold text-brand">{{ $address->address }}</p>
                            </div>
                            
                            {{-- Fila 4: Referencia --}}
                            <div class="md:col-span-2">
                                <p class="text-sm font-medium text-gray-500">Referencia Adicional</p>
                                <p class="text-lg italic text-gray-600">{{ $address->reference ?? 'No hay referencia adicional.' }}</p>
                            </div>
                        </div>
                    @else
                        <div class="p-6 bg-brand border border-pink-300 rounded-lg text-brand text-center">
                            <i class="fa-solid fa-circle-exclamation mr-2"></i> Aún no has configurado una dirección principal.
                        </div>
                    @endif
                </section>

            </div>
        </div>
    </main>

    <footer class="bg-white border-t mt-12 py-8 text-center text-gray-500 text-sm">
        <p>&copy; {{ date('Y') }} Little Wonders. Hecho con amor.</p>
    </footer>

</body>
</html>