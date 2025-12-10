<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $categoriaSeleccionada = $request->category;

        //  Palabras clave por categoría (para búsqueda y auto-asignación)
        $categorias = [
            'ropa' => ['body', 'conjunto', 'mameluco', 'pantalón', 'ropa', 'vestido'],
            'juguetes' => ['gimnasio', 'juguete', 'sonajero', 'didáctico', 'peluche'],
            'lactancia' => ['leche materna', 'extractor', 'biberón', 'pañales', 'maternidad'],
            'maternidad' => ['embarazo', 'crema', 'cuidado', 'madre'],
            'movilidad' => ['coche', 'carrito', 'silla', 'paseo'],
            'tecnologia' => ['monitor', 'cámara', 'termostato', 'electrónico']
        ];

        // Query base
        $query = Producto::query();

        //  Búsqueda por texto
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'LIKE', "%$search%")
                  ->orWhere('descripcion', 'LIKE', "%$search%");
            });
        }

        //  Filtrar por categoría usando palabras clave
        if ($categoriaSeleccionada && isset($categorias[$categoriaSeleccionada])) {
            $keywords = $categorias[$categoriaSeleccionada];

            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $q->orWhere('nombre', 'LIKE', "%$keyword%")
                      ->orWhere('descripcion', 'LIKE', "%$keyword%");
                }
            });
        }

        // Ordenar y paginar
        $productos = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('producto', ['productos' => $productos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.new');
    }


    /**
     * AUTO-ASIGNAR CATEGORÍA según palabras clave
     */
    private function detectarCategoria($nombre, $descripcion)
    {
        $texto = strtolower($nombre . ' ' . $descripcion);

        $categorias = [
            'ropa' => ['body', 'conjunto', 'mameluco', 'pantalón', 'ropa', 'vestido'],
            'juguetes' => ['gimnasio', 'juguete', 'sonajero', 'didáctico', 'peluche'],
            'lactancia' => ['leche materna', 'extractor', 'biberón', 'pañales', 'maternidad'],
            'maternidad' => ['embarazo', 'crema', 'cuidado', 'madre'],
            'movilidad' => ['coche', 'carrito', 'silla', 'paseo'],
            'tecnologia' => ['monitor', 'cámara', 'termostato', 'electrónico']
        ];

        foreach ($categorias as $categoria => $keywords) {
            foreach ($keywords as $palabra) {
                if (str_contains($texto, strtolower($palabra))) {
                    return $categoria; // devuelve la categoría detectada
                }
            }
        }

        return null; // No se encontró categoría
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:100',
            'descripcion' => 'required|max:150',
            'precio' => 'max:7',
            'cantidad' => 'max:100',
            'foto'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        //  AUTO-DETECTAR la categoría según nombre y descripción
        $categoriaDetectada = $this->detectarCategoria($request->nombre, $request->descripcion);

        // Crear el producto
        $data = $request->all();
        $data['categoria'] = $categoriaDetectada; // guardar automáticamente

        Producto::create($data);

        return redirect('productos')
                ->with('type', 'success')
                ->with('message', 'Producto agregado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Producto::findOrFail($id);

        $relacionados = Producto::where('id', '!=', $id)
                                ->inRandomOrder()
                                ->take(4)
                                ->get();

        return view('productos.show', compact('producto', 'relacionados'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $datos = Producto::find($id);
        return view('productos.edit', compact('datos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:100',
            'descripcion' => 'required|max:150',
            'precio' => 'max:7',
            'cantidad' => 'max:100',
            'foto'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        //  VOLVER A DETECTAR categoría cuando se edita
        $categoriaDetectada = $this->detectarCategoria($request->nombre, $request->descripcion);

        $data = $request->all();
        $data['categoria'] = $categoriaDetectada;

        $producto->update($data);

        return redirect('productos')
                ->with('type', 'warning')
                ->with('message', 'Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Producto::destroy($id);

        return redirect('productos')
                ->with('type', 'danger')
                ->with('message', 'El producto se eliminó correctamente');
    }
}
