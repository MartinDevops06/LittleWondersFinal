<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Muestra la vista de inicio de sesión.
     */
    public function index()
    {
        return view('user.SessionUser');
    }

    /**
     * Muestra la vista de registro.
     */
    public function create()
    {
        return view('user.RegisterUser');
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|confirmed|min:6',
            'phone'      => 'required|string|max:20', // Añadí string|max:20 por buena práctica
            'birth_date' => 'required|date'
        ]);

        $user = User::create([
            'name'       => $request->name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => bcrypt($request->password), // ¡Buena práctica usar bcrypt!
            'phone'      => $request->phone,
            'birth_date' => $request->birth_date,
            'is_admin'   => false
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        // Asumo que 'address' es la ruta para continuar el proceso post-registro
        return redirect()->route('address'); 
    }

    /**
     * Muestra la información de perfil del usuario (Vista de solo lectura).
     * Nota: Mantenemos el método 'show' para seguir la convención RESTful.
     */
    public function show($id) 
    {
        // 1. Encontrar el usuario
        $user = User::findOrFail($id);

        // 2. Seguridad: Asegurar que es el usuario autenticado
        if (Auth::id() !== $user->id) {
            abort(403, 'Acceso no autorizado.'); 
        }

        // 3. Cargar la dirección principal o la primera dirección del usuario.
        $address = $user->addresses()->first();

        // 4. Retornar la vista de solo lectura
        return view('user.show', compact('user', 'address'));
    }

    /**
     * Muestra el formulario para editar los datos personales del usuario.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        
        // 🚨 CRÍTICO: Usar una vista de edición, no la de registro.
        // Si 'user.RegisterUser' es el formulario de edición, está bien.
        // Si no tienes una vista de edición separada, te recomiendo crear 'user.edit_profile'.
        return view('user.RegisterUser', compact('user'));
    }

    /**
     * Actualiza los datos personales del usuario.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        // Seguridad: Solo el dueño puede editar su perfil
        if (Auth::id() !== $user->id) {
            return redirect()->route('User.show', $user->id)->with('error', 'Acceso denegado para editar este perfil.');
        }

        $request->validate([
            'name'       => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'phone'      => 'required|string|max:20',
            'birth_date' => 'required|date',
            // Clave: Permite que el email se mantenga igual, pero falla si otro usuario ya lo usa.
            'email'      => 'required|email|unique:users,email,' . $user->id, 
        ]);

        $user->update($request->only([
            'name',
            'last_name',
            'phone',
            'birth_date',
            'email'
        ]));

        // Mejorar la redirección: Volver a la vista de perfil con un mensaje de éxito.
        return redirect()->route('User.show', $user->id)->with('success', 'Datos actualizados con éxito.');
    }
    public function login(Request $request)
    {
        // 1. Validar las credenciales
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // 2. Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            
            // 3. Si tiene éxito: Regenerar la sesión (¡Clave!)
            $request->session()->regenerate();

            // 4. Redirigir al destino previsto (o a la página de inicio)
            // Esto usa el método intended() de Laravel para llevarlo donde quería ir
            return redirect()->intended(route('home')); 
        }

        // 5. Si falla: Volver al formulario con un error
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    /**
     * Cierra la sesión del usuario (Logout).
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/'); // Redirigir a la página principal
    }
}
