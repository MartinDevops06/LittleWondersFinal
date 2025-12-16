@php
    $user = Auth::user();
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('FotosPromocionales/logo.svg') }}" type="image/x-icon">
    <title>Little Wonders | Registro</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Paleta colores -->
    <style>
        .bg-brand { background-color: #fce7f3; }
        .text-brand { color: #db2777; }
        .btn-primary { background-color: #db2777; color: white; }
        .btn-primary:hover { background-color: #be185d; }
    </style>
</head>

<body class="bg-gray-50 font-sans">

    <!-- NAVBAR -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 grid grid-cols-3 items-center">

            <!-- Rollback -->
            <div class="flex">
                <a href="javascript:history.back()" class="text-gray-500 hover:text-brand flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> Volver a la tienda
                </a>
            </div>

            <!-- LOGO -->
            <div class="flex justify-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-brand flex items-center gap-2">
                    <i class="fa-solid fa-baby-carriage"></i> Little Wonders
                </a>
            </div>

            <!-- Usuario -->
            @auth
                <a href="{{ route('User.show') }}" class="text-gray-600 hover:text-brand transition">
                    <p>{{ Auth::user()->name }}</p>
                </a>
            @else
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-brand transition">
                    <i class="fa-solid fa-user text-xl"></i>
                </a>
            @endauth


        </div>
    </nav>

    <!-- CONTENEDOR REGISTRO -->
    <div class="flex justify-center items-center min-h-screen px-4">

        <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md border-t-4 border-pink-400">

            <div class="text-center mb-6">
                <i class="fa-solid fa-baby text-brand text-4xl mb-2"></i>
                <h2 class="text-2xl font-bold text-gray-700">Cual es tu direccion?</h2>
                <p class="text-gray-500 text-sm">Únete a nuestra familia Little Wonders 💕</p>
            </div>

            <!-- FORMULARIO -->
            <form action="{{ route('address.store') }}" method="POST">
                @csrf

                {{-- REDIRECT (MUY IMPORTANTE) --}}
                @if(isset($redirect))
                    <input type="hidden" name="redirect" value="{{ $redirect }}">
                @endif

                {{-- NOMBRE DE CONTACTO --}}
                <div class="mb-4">
                    <label class="block mb-1">Nombre de contacto</label>
                    <input type="text" name="contact_name" class="w-full border p-2" required>
                </div>

                {{-- TELÉFONO --}}
                <div class="mb-4">
                    <label class="block mb-1">Teléfono</label>
                    <input type="text" name="contact_phone" class="w-full border p-2" required>
                </div>

                {{-- CIUDAD --}}
                <div class="mb-4">
                    <label class="block mb-1">Ciudad</label>
                    <input type="text" name="city" class="w-full border p-2" required>
                </div>

                {{-- DEPARTAMENTO --}}
                <div class="mb-4">
                    <label class="block mb-1">Departamento</label>
                    <input type="text" name="department" class="w-full border p-2" required>
                </div>

                {{-- DIRECCIÓN --}}
                <div class="mb-4">
                    <label class="block mb-1">Dirección</label>
                    <input type="text" name="address" class="w-full border p-2" required>
                </div>

                <button type="submit" class="btn-primary w-full py-3 rounded-full font-semibold uppercase tracking-wider shadow-lg shadow-pink-200">
                    Guardar dirección
                </button>
            </form>

        </div>
    </div>

</body>
</html>