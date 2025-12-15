<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        return view('user.RegisterAddress', [
            'redirect' => $request->redirect
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'contact_name'   => 'required|string|max:255',
            'contact_phone'  => 'required|string|max:20',
            'city'           => 'required|string|max:255',
            'department'     => 'required|string|max:255',
            'address'        => 'required|string|max:255',
            'reference'      => 'nullable|string|max:255',
        ]);

        auth()->user()->addresses()->create($request->all());

        // 🔁 Volver a la página anterior (checkout)
        if ($request->filled('redirect')) {
            return redirect($request->redirect)
                ->with('success', 'Dirección agregada correctamente');
        }

        return redirect()
            ->route('User.show')
            ->with('success', 'Dirección agregada correctamente');
    }




    public function destroy($id)
    {
        $address = Address::findOrFail($id);

        // Seguridad
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        // No permitir borrar dirección principal
        if ($address->is_primary) {
            return back()->with('error', 'No puedes eliminar la dirección principal');
        }

        // 🚫 NO permitir borrar si tiene pedidos asociados
        if ($address->orders()->exists()) {
            return back()->with(
                'error',
                'No puedes eliminar esta dirección porque ya fue usada en un pedido'
            );
        }

        $address->delete();

        return back()->with('success', 'Dirección eliminada correctamente');
    }


    public function show($id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() !== $user->id) {
            abort(403, 'Acceso no autorizado.');
        }

        // Dirección principal
        $address = $user->addresses()
            ->where('is_primary', true)
            ->first();

        // Otras direcciones
        $otherAddresses = $user->addresses()
            ->where('is_primary', false)
            ->get();

        return view('user.show', compact(
            'user',
            'address',
            'otherAddresses'
        ));
    }

}
