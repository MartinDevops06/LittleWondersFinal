@if ($productos->isEmpty())
    <p class="text-gray-500">No hay existencia de Vestimenta.</p>
@else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach ($productos as $producto)
            <div class="bg-white shadow-md rounded-lg p-4 hover:shadow-lg transition">
                
                {{-- 1. IMAGEN DEL PRODUCTO (Añadido) --}}
                <img src="{{ asset('storage/ImagenesProductos/' . $producto->foto) }}" 
                    class="w-full h-56 object-cover rounded-lg" 
                    alt="{{ $producto->nombre }}">

                {{-- 2. NOMBRE DEL PRODUCTO --}}
                <h3 class="mt-4 text-lg font-semibold text-gray-700">
                    {{ $producto->nombre }}
                </h3>

                {{-- 3. DESCRIPCIÓN CORTA (Usando Str::limit para acortar) --}}
                <p class="text-gray-500 text-sm mt-1">
                    {{ Str::limit($producto->descripcion, 80) }}
                </p>

                {{-- 4. PRECIO --}}
                <p class="mt-3 font-bold text-pink-600 text-lg">
                    ${{ number_format($producto->precio, 0, ',', '.') }}
                </p>

                {{-- 5. ENLACE PARA VER DETALLE (Añadido) --}}
                <a href="{{ route('productos.show', $producto->id) }}"
                    class="mt-3 block text-center bg-pink-600 text-white py-2 rounded-lg hover:bg-pink-700 transition">
                    Ver producto
                </a>
            </div>
        @endforeach
    </div>
@endif