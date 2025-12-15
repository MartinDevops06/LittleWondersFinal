<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        return view('user.SessionUser');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas',
        ])->onlyInput('email');
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTRO
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('user.RegisterUser');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|confirmed|min:6',
            'phone'      => 'required|string|max:20',
            'birth_date' => 'required|date'
        ]);

        $user = User::create([
            'name'       => $request->name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => bcrypt($request->password),
            'phone'      => $request->phone,
            'birth_date' => $request->birth_date,
            'is_admin'   => false
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('address.index');
    }

    /*
    |--------------------------------------------------------------------------
    | PERFIL (AUTH)
    |--------------------------------------------------------------------------
    */
    
    public function show()
    {
        $user = Auth::user();
        $addresses = $user->addresses;

        return view('user.show', compact('user', 'addresses'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('user.RegisterUser', compact('user'));
    }



    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'       => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'phone'      => 'required|string|max:20',
            'birth_date' => 'required|date',
            'email'      => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only([
            'name',
            'last_name',
            'phone',
            'birth_date',
            'email'
        ]));

        return redirect()
            ->route('User.show')
            ->with('success', 'Datos actualizados con éxito.');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
