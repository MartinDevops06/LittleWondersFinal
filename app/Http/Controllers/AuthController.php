<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1️⃣ Validación de campos
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 2️⃣ Buscar usuario
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Este correo no está registrado.']);
        }

        // 3️⃣ Verificar contraseña
        $user->password = Hash::make($request->password);
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'La contraseña es incorrecta.']);
        }

        // 4️⃣ Iniciar sesión
        Auth::login($user);

        // 5️⃣ Redirigir
        return redirect()->route('home');
    }
}

