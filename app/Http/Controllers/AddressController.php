<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth; 

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.RegisterAddress');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validación de datos
        $request->validate([
            'contact_name' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'department' => 'required|string|max:100', // Nota: Tu HTML usaba 'country'
            'reference' => 'nullable|string|max:255',
        ]);

        // Asegúrate de que un usuario esté logueado
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['msg' => 'Debes iniciar sesión para añadir una dirección.']);
        }

        // 2. Crear el registro en la base de datos
        Address::create([
            'user_id' => Auth::id(), // Asocia la dirección al usuario actual
            'contact_name' => $request->contact_name,
            'contact_phone' => $request->contact_phone,
            'address' => $request->address,
            'city' => $request->city,
            'department' => $request->department,
            'reference' => $request->reference,
        ]);

        // 3. Redireccionar al usuario a donde necesites
        // Por ejemplo, a su perfil o a la página de pago
        return redirect()->route('home')->with('success', '¡Dirección guardada correctamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
