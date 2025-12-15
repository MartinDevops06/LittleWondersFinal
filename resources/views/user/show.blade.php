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

        <div class="flex items-center gap-4">

            <a href="{{ route('carrito.mostrar') }}" class="relative text-gray-600 hover:text-brand">
                <i class="fa-solid fa-cart-shopping text-xl"></i>
                <span class="absolute -top-2 -right-2 bg-pink-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                    {{ count(Session::get('carrito', [])) }}
                </span>
            </a>

            <div x-data="{ open: false }" class="relative">
                @auth
                    <button @click="open = !open" class="flex items-center gap-2 text-gray-600 hover:text-brand">
                        <i class="fa-solid fa-user"></i>
                        <span>{{ Auth::user()->name }}</span>
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </button>

                    <div x-show="open" @click.outside="open = false"
                         class="absolute right-0 mt-2 w-44 bg-white border rounded-lg shadow-md">

                        {{-- PERFIL --}}
                        <a href="{{ route('User.show') }}"
                           class="block px-4 py-2 text-sm font-bold hover:bg-gray-100">
                            Mi Perfil
                        </a>

                        {{-- EDITAR PERFIL --}}
                        <a href="{{ route('User.edit') }}"
                           class="block px-4 py-2 text-sm hover:bg-gray-100">
                            Editar datos
                        </a>

                        {{-- LOGOUT --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                Cerrar sesión
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-brand">
                        <i class="fa-solid fa-user text-xl"></i>
                    </a>
                @endauth
            </div>

        </div>
    </div>
</nav>

<main class="container mx-auto px-4 py-10">

    @if(session('success'))
        <div class="max-w-4xl mx-auto mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="max-w-4xl mx-auto bg-white shadow rounded-xl p-8">

        <h1 class="text-3xl font-bold text-center text-brand mb-8">
            Información de Mi Perfil
        </h1>

        {{-- DATOS PERSONALES --}}
        <section class="mb-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Datos personales</h2>
                <a href="{{ route('User.edit') }}" class="btn-primary px-4 py-1 rounded">
                    Editar
                </a>
            </div>

            <p><strong>Nombre:</strong> {{ $user->name }} {{ $user->last_name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Teléfono:</strong> {{ $user->phone ?? 'N/A' }}</p>
            <p><strong>Fecha nacimiento:</strong>
                {{ $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('d/m/Y') : 'No especificada' }}
            </p>
        </section>

        {{-- DIRECCIONES --}}
        <section>
            <div class="flex justify-between mb-4">
                <h2 class="text-xl font-semibold">Direcciones</h2>
                <a href="{{ route('address.index') }}" class="btn-primary px-4 py-1 rounded">
                    + Agregar
                </a>
            </div>

            @forelse ($addresses as $item)
                <div class="border p-4 rounded mb-3 flex justify-between">
                    <div>
                        <p class="font-semibold">{{ $item->contact_name }} ({{ $item->contact_phone }})</p>
                        <p class="text-sm text-gray-600">
                            {{ $item->address }} – {{ $item->city }}, {{ $item->department }}
                        </p>
                    </div>

                    <form method="POST" action="{{ route('address.destroy', $item->id) }}"
                          onsubmit="return confirm('¿Eliminar esta dirección?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500 hover:text-red-700">Eliminar</button>
                    </form>
                </div>
            @empty
                <p class="text-center text-gray-500">No tienes direcciones registradas.</p>
            @endforelse
        </section>

    </div>
</main>

</body>
</html>
