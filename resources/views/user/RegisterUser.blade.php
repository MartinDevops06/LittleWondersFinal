<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('FotosPromocionales/logo.svg') }}" type="image/x-icon">
    <title>Little Wonders | {{ isset($user) ? 'Editar datos' : 'Registro' }}</title>

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

    <!-- Navbar -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 grid grid-cols-3 items-center">

            <!-- Rollback -->
            <div>
                <a href="javascript:history.back()" class="text-gray-500 hover:text-brand flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> Volver
                </a>
            </div>

            <!-- Logo -->
            <div class="flex justify-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-brand flex items-center gap-2">
                    <i class="fa-solid fa-baby-carriage"></i> Little Wonders
                </a>
            </div>
        </div>
    </nav>

    <!-- Contenedor de formulario -->
    <div class="flex justify-center items-center min-h-screen px-4">
        <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md border-t-4 border-pink-400">

            <div class="text-center mb-6">
                <i class="fa-solid fa-baby text-brand text-4xl mb-2"></i>
                <h2 class="text-2xl font-bold text-gray-700">
                    {{ isset($user) ? 'Editar tus datos' : '¿Cuáles son tus datos?' }}
                </h2>
                <p class="text-gray-500 text-sm">
                    {{ isset($user) ? 'Actualiza tu información' : 'Únete a nuestra familia Little Wonders' }}
                </p>
            </div>

            <!-- Formulario para el registro o edit del user -->
            <form method="POST"
                action="{{ isset($user) ? route('User.update', $user->id) : route('register.store') }}">
                @csrf
                @isset($user)
                    @method('PUT')
                @endisset

                <div class="mb-4">
                    <label class="block mb-2 text-gray-600 font-medium">Nombre</label>
                    <input type="text" name="name" required
                        value="{{ old('name', $user->name ?? '') }}"
                        class="w-full px-4 py-2 border rounded-lg bg-gray-50 @error('name') border-red-500 @enderror">
                    @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 text-gray-600 font-medium">Apellido</label>
                    <input type="text" name="last_name" required
                        value="{{ old('last_name', $user->last_name ?? '') }}"
                        class="w-full px-4 py-2 border rounded-lg bg-gray-50 @error('last_name') border-red-500 @enderror">
                    @error('last_name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 text-gray-600 font-medium">Teléfono</label>
                    <input type="text" name="phone" required
                        value="{{ old('phone', $user->phone ?? '') }}"
                        class="w-full px-4 py-2 border rounded-lg bg-gray-50 @error('phone') border-red-500 @enderror">
                    @error('phone') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 text-gray-600 font-medium">Fecha de nacimiento</label>
                    <input type="date" name="birth_date" required
                        value="{{ old('birth_date', isset($user) && $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('Y-m-d') : '') }}"
                        class="w-full px-4 py-2 border rounded-lg bg-gray-50 @error('birth_date') border-red-500 @enderror">
                    @error('birth_date') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 text-gray-600 font-medium">Correo electrónico</label>
                    <input type="email" name="email" required
                        value="{{ old('email', $user->email ?? '') }}"
                        class="w-full px-4 py-2 border rounded-lg bg-gray-50 @error('email') border-red-500 @enderror">
                    @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                @unless(isset($user))
                    <div class="mb-4">
                        <label class="block mb-2 text-gray-600 font-medium">Contraseña</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-2 border rounded-lg bg-gray-50">
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 text-gray-600 font-medium">Confirmar contraseña</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full px-4 py-2 border rounded-lg bg-gray-50">
                    </div>
                @endunless

                <button type="submit" class="w-full btn-primary py-2 rounded-full text-lg">
                    {{ isset($user) ? 'Guardar cambios' : 'Continuar' }}
                </button>
            </form>

            @unless(isset($user))
                <p class="text-center text-sm text-gray-500 mt-4">
                    ¿Ya tienes una cuenta?
                    <a href="{{ route('login') }}" class="text-brand font-semibold">
                        Inicia sesión
                    </a>
                </p>
            @endunless
        </div>
    </div>

</body>
</html>
