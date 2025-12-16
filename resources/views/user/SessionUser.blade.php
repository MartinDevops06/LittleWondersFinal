
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/logo.svg') }}" type="image/x-icon">
    <title>Little Wonders | Iniciar Sesión</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Paleta colores-->
    <style>
        .bg-brand { background-color: #fce7f3; }
        .text-brand { color: #db2777; }
        .btn-primary { background-color: #db2777; color: rgb(255, 255, 255); }
        .btn-primary:hover { background-color: #be185d; }
    </style>
</head>

<body class="bg-gray-50 font-sans">

    <!-- NAVBAR igual al diseño principal -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">

        <div class="container mx-auto px-4 py-4 grid grid-cols-3 items-center">

            <!-- Rollback -->
            <div class="flex">
                <a href="javascript:history.back()" class="text-gray-500 hover:text-brand flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> Volver a la tienda
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

    <!-- CONTENEDOR LOGIN -->
    <div class="flex justify-center items-center min-h-screen px-4">

        <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md border-t-4 border-pink-400">

            <div class="text-center mb-6">
                <i class="fa-solid fa-heart text-brand text-4xl mb-2"></i>
                <h2 class="text-2xl font-bold text-gray-700">Bienvenidos💗</h2>
                <p class="text-gray-500 text-sm">Inicia sesión para continuar</p>
            </div>

            <!-- FORM de Login -->
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <label class="block mb-2 text-gray-600 font-medium">Correo electrónico</label>
                <input type="email" name="email" required
                    class="w-full px-4 py-2 mb-4 border rounded-lg bg-gray-50
                        focus:outline-none focus:border-pink-400">
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

                <label class="block mb-2 text-gray-600 font-medium">Contraseña</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 mb-4 border rounded-lg bg-gray-50
                        focus:outline-none focus:border-pink-400">
                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

                <button type="submit" class="w-full btn-primary py-2 rounded-full text-lg">
                    Iniciar sesión
                </button>

                <!-- Redireccionamiento a registrar usuario -->
                <p class="text-center mt-6 text-gray-600 text-sm">
                    ¿No tienes cuenta? 
                    <a href="{{ route('register') }}" class="text-brand font-medium hover:underline">Regístrate</a>
                </p>
            </form>
        </div>
    </div>

</body>
</html>