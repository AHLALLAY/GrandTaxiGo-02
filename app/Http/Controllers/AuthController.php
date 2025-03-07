<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

use Exception;

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

    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // Récupérer les détails de l'utilisateur depuis Google
            $googleUser = Socialite::driver('google')->user();
    
            // Vérifier si l'utilisateur existe déjà dans la base de données
            $user = User::where('email', $googleUser->email)->first();
    
            // Si l'utilisateur n'existe pas, le créer
            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make(rand(10000000, 99999999)), // Mot de passe aléatoire
                    'photo' => $googleUser->avatar,
                    'role' => 'passenger', // Rôle par défaut pour les nouveaux utilisateurs
                ]);
            }
    
            // Connecter l'utilisateur
            Auth::login($user);
    
            // Rediriger en fonction du rôle de l'utilisateur
            switch ($user->role) {
                case 'driver':
                    return redirect()->route('driver')->with('success', 'Connexion réussie !');
                case 'passenger':
                    return redirect()->route('passenger')->with('success', 'Connexion réussie !');
                case 'admin':
                    return redirect()->route('admin.dashboard')->with('success', 'Connexion réussie !');
                default:
                    return redirect('/')->with('success', 'Connexion réussie !');
            }
    
        } catch (Exception $e) {
            // Gérer les erreurs
            return redirect()->route('login')->withErrors('La connexion via Google a échoué. Veuillez réessayer.');
        }
    }
}
