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

    <!-- NAVBAR -->
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
                <h2 class="text-2xl font-bold text-gray-700">Cual es tu direccion?</h2>
                <p class="text-gray-500 text-sm">Únete a nuestra familia Little Wonders 💕</p>
            </div>

            <!-- FORMULARIO -->
            <form action="{{ route('address.store') }}" method="POST">
                @csrf

                <!-- Campos requeridos por el modelo y la validación -->
                <label class="block mb-2 text-gray-600 font-medium">Nombre de Contacto</label>
                <input type="text" name="contact_name" required value="{{ old('contact_name') }}"
                    class="w-full px-4 py-2 mb-4 border rounded-lg bg-gray-50 focus:outline-none focus:border-pink-400">
                <!-- Agregar manejo de errores como se explicó anteriormente -->
                @error('contact_name') <p class="text-red-500 text-xs mt-1 mb-4">{{ $message }}</p> @enderror


                <label class="block mb-2 text-gray-600 font-medium">Teléfono de Contacto</label>
                <input type="text" name="contact_phone" required value="{{ old('contact_phone') }}"
                    class="w-full px-4 py-2 mb-4 border rounded-lg bg-gray-50 focus:outline-none focus:border-pink-400">
                @error('contact_phone') <p class="text-red-500 text-xs mt-1 mb-4">{{ $message }}</p> @enderror


                <!-- Campos que ya tenías -->
                <label class="block mb-2 text-gray-600 font-medium">Ciudad</label>
                <input type="text" name="city" required value="{{ old('city') }}"
                    class="w-full px-4 py-2 mb-4 border rounded-lg bg-gray-50 focus:outline-none focus:border-pink-400">
                @error('city') <p class="text-red-500 text-xs mt-1 mb-4">{{ $message }}</p> @enderror


                <label class="block mb-2 text-gray-600 font-medium">Departamento</label>
                <!-- NOTA: Cambié el name="country" de tu HTML original a name="department" para que coincida con tu modelo Address -->
                <input type="text" name="department" required value="{{ old('department') }}"
                    class="w-full px-4 py-2 mb-4 border rounded-lg bg-gray-50 focus:outline-none focus:border-pink-400">
                @error('department') <p class="text-red-500 text-xs mt-1 mb-4">{{ $message }}</p> @enderror


                <label class="block mb-2 text-gray-600 font-medium">Dirección</label>
                <input type="text" name="address" required value="{{ old('address') }}"
                    class="w-full px-4 py-2 mb-4 border rounded-lg bg-gray-50 focus:outline-none focus:border-pink-400">
                @error('address') <p class="text-red-500 text-xs mt-1 mb-4">{{ $message }}</p> @enderror

                
                <label class="block mb-2 text-gray-600 font-medium">Referencia (Opcional)</label>
                <input type="text" name="reference" value="{{ old('reference') }}"
                    class="w-full px-4 py-2 mb-4 border rounded-lg bg-gray-50 focus:outline-none focus:border-pink-400">
                @error('reference') <p class="text-red-500 text-xs mt-1 mb-4">{{ $message }}</p> @enderror


                <div class="text-center mt-4">
                    <!-- El botón debe ser type="submit" para enviar el formulario -->
                    <button type="submit" class="w-full btn-primary py-2 rounded-full text-lg">
                        Guardar Dirección
                    </button>
                </div>
            </form>


            <!-- Link de volver a login -->
            <p class="text-center mt-6 text-gray-600 text-sm">
                ¿Ya tienes cuenta? 
                <a href="Login.html" class="text-brand font-medium hover:underline">
                    Inicia sesión
                </a>
            </p>
        </div>
    </div>

</body>
</html>

