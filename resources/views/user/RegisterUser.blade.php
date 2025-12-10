<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Little Wonders | Registro</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .bg-brand { background-color: #fce7f3; }
        .text-brand { color: #db2777; }
        .btn-primary { background-color: #db2777; color: white; }
        .btn-primary:hover { background-color: #be185d; }
        
    </style>
</head>

<body class="bg-gray-50 font-sans">

    <!-- NAVBAR igual al diseño principal -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">

        <div class="container mx-auto px-4 py-4 grid grid-cols-3 items-center">

            <div class="flex">
                <a href="javascript:history.back()" class="text-gray-500 hover:text-brand flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> Volver a la tienda
                </a>
            </div>

            <div class="flex justify-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-brand flex items-center gap-2">
                    <i class="fa-solid fa-baby-carriage"></i> Little Wonders
                </a>
            </div>

        </div>
    
    </nav>

    <!-- CONTENEDOR REGISTRO -->
    <div class="flex justify-center items-center min-h-screen px-4">

        <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md border-t-4 border-pink-400">

            <div class="text-center mb-6">
                <i class="fa-solid fa-baby text-brand text-4xl mb-2"></i>
                <h2 class="text-2xl font-bold text-gray-700">Crear Cuenta</h2>
                <p class="text-gray-500 text-sm">Únete a nuestra familia Little Wonders</p>
            </div>

            <!-- FORMULARIO -->
            <form action="{{ route('storeUser') }}" method="POST">
                @csrf

                <!-- Nombre -->
                <label class="block mb-2 text-gray-600 font-medium">Nombre</label>
                <input type="text" name="name" required value="{{ old('name') }}"
                    class="w-full px-4 py-2 mb-4 border rounded-lg bg-gray-50 @error('name') border-red-500 @enderror">
                <!-- Muestra el error para 'name' -->
                @error('name')
                    <p class="text-red-500 text-xs mt-1 mb-4">{{ $message }}</p>
                @enderror

                <!-- Apellido -->
                <label class="block mb-2 text-gray-600 font-medium">Apellido</label>
                <input type="text" name="last_name" required value="{{ old('last_name') }}"
                    class="w-full px-4 py-2 mb-4 border rounded-lg bg-gray-50 @error('last_name') border-red-500 @enderror">
                @error('last_name')
                    <p class="text-red-500 text-xs mt-1 mb-4">{{ $message }}</p>
                @enderror

                <!-- Teléfono -->
                <label class="block mb-2 text-gray-600 font-medium">Teléfono</label>
                <input type="text" name="phone" required value="{{ old('phone') }}"
                    class="w-full px-4 py-2 mb-4 border rounded-lg bg-gray-50 @error('phone') border-red-500 @enderror">
                @error('phone')
                    <p class="text-red-500 text-xs mt-1 mb-4">{{ $message }}</p>
                @enderror

                <!-- Fecha de nacimiento -->
                <label class="block mb-2 text-gray-600 font-medium">Fecha de nacimiento</label>
                <input type="date" name="birth_date" required value="{{ old('birth_date') }}"
                    class="w-full px-4 py-2 mb-4 border rounded-lg bg-gray-50 @error('birth_date') border-red-500 @enderror">
                @error('birth_date')
                    <p class="text-red-500 text-xs mt-1 mb-4">{{ $message }}</p>
                @enderror

                <!-- Email -->
                <label class="block mb-2 text-gray-600 font-medium">Correo electrónico</label>
                <input type="email" name="email" required value="{{ old('email') }}"
                    class="w-full px-4 py-2 mb-4 border rounded-lg bg-gray-50 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-xs mt-1 mb-4">{{ $message }}</p>
                @enderror

                <!-- Contraseña -->
                <label class="block mb-2 text-gray-600 font-medium">Contraseña</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 mb-4 border rounded-lg bg-gray-50 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-xs mt-1 mb-4">{{ $message }}</p>
                @enderror

                <!-- Confirmación -->
                <label class="block mb-2 text-gray-600 font-medium">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" required
                    class="w-full px-4 py-2 mb-4 border rounded-lg bg-gray-50 @error('password_confirmation') border-red-500 @enderror">
                <!-- El error de confirmación se asocia al campo 'password' en Laravel, pero puedes usar 'password_confirmation' si quieres un mensaje específico -->

                <button type="submit" class="w-full btn-primary py-2 rounded-full text-lg">
                    Continuar
                </button>
            </form>

        </div>
    </div>

</body>
</html>
