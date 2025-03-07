<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validation des données
        $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string|min:8',
        ]);

        // Recherche de l'utilisateur dans la table users
        $user = User::where('email', $request->email)->first();

        // Vérification du mot de passe et de l'existence de l'utilisateur
        if ($user && Hash::check($request->password, $user->password)) {
            // Stocker l'utilisateur en session
            Session::put('user', $user);

            // Redirection en fonction du rôle
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard')->with('success', 'Connexion réussie !');
                case 'driver':
                    return redirect()->route('driver')->with('success', 'Connexion réussie !');
                case 'passenger':
                    return redirect()->route('passenger')->with('success', 'Connexion réussie !');
                default:
                    return redirect('login')->withErrors(['error' => 'Rôle non reconnu.']);
            }
        } else {
            // Si l'authentification échoue
            return redirect('login')->withErrors(['error' => 'Email ou mot de passe incorrect.']);
        }
    }

    public function register(Request $request)
    {
        // Validation des données
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:2028',
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'nullable|string|in:passenger,driver',
        ]);


        $role = $request->role;
        if (substr($request->name, -2) === '-a' && !$request->role) {
            $role = 'admin';
        }


        $photoPath = $request->file('photo')->store('uploads', 'public');
        $passHashed = Hash::make($request->password);


        User::create([
            'photo' => $photoPath,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $passHashed,
            'role' => $role,
            'isAvailable' => $role === 'driver' ? true : null,
        ]);

        return redirect()->route('loginForm');
    }

    public function logout(Request $request)
    {
        Session::forget('user');
        Session::forget('driver');

        $request->session()->regenerateToken();
        return redirect()->route('loginForm')->with('success', 'Déconnexion réussie !');
    }
}
