<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthController extends Controller
{
    /**
     * Gère la connexion de l'utilisateur.
     */
    public function login(Request $request)
    {
        // Validation des données
        $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string|min:8',
        ]);

        // Recherche de l'utilisateur dans la base de données
        $user = User::where('email', $request->email)->first();
        dd($user);

        // Vérification du mot de passe et de l'existence de l'utilisateur
        if ($user && Hash::check($request->password, $user->password)) {
            // Authentification de l'utilisateur
            Auth::login($user);

            // Redirection en fonction du rôle
            switch ($user->roles) {
                case 'admin':
                    return redirect()->route('admin')->with('success', 'Connexion réussie !');
                case 'driver':
                    return redirect()->route('driver')->with('success', 'Connexion réussie !');
                case 'passenger':
                    return redirect()->route('passenger')->with('success', 'Connexion réussie !');
                default:
                    return redirect()->route('loginForm')->withErrors(['error' => 'Rôle non reconnu.']);
            }
        } else {
            // Si l'authentification échoue
            return redirect()->route('loginForm')->withErrors(['error' => 'Email ou mot de passe incorrect.']);
        }
    }

    public function register(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:5028',
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'nullable|string|in:passenger,driver',
        ]);

        // Détermination du rôle
        $role = $this->determineRole($validatedData['name'], $validatedData['role'] ?? null);

        // Téléchargement de la photo
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('uploads', 'public');
            if (!$photoPath) {
                return back()->withErrors(['photo' => 'Erreur lors du téléchargement de l\'image.']);
            }
        } else {
            return back()->withErrors(['photo' => 'Aucun fichier téléchargé.']);
        }

        // Création de l'utilisateur
        User::create([
            'photo' => $photoPath,
            'name' => $this->formatName($validatedData['name']),
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'roles' => $role,
            'isAvailable' => $role === 'driver' ? true : null,
        ]);

        return redirect()->route('loginForm')->with('success', 'Inscription réussie !');
    }

    /**
     * Gère la déconnexion de l'utilisateur.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginForm')->with('success', 'Déconnexion réussie !');
    }

    /**
     * Redirige l'utilisateur vers Google pour l'authentification.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Gère le callback de l'authentification Google.
     */
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
                    'password' => Hash::make(Str::random(16)),
                    'photo' => $googleUser->avatar,
                    'roles' => 'passenger',
                ]);
            }

            // Connecter l'utilisateur
            Auth::login($user);

            // Envoyer un email de bienvenue
            Mail::to($user->email)->send(new WelcomeEmail($user));

            // Rediriger en fonction du rôle de l'utilisateur
            switch ($user->roles) {
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
            // Enregistrer l'erreur dans les logs
            Log::error('Erreur lors de la connexion via Google : ' . $e->getMessage());

            // Rediriger avec un message d'erreur
            return redirect()->route('loginForm')->withErrors('La connexion via Google a échoué. Veuillez réessayer.');
        }
    }

    /**
     * Détermine le rôle de l'utilisateur.
     */
    private function determineRole($name, $requestRole)
    {
        if (substr($name, -2) === '-a') {
            return 'admin';
        }
        return $requestRole ?? 'passenger';
    }

    /**
     * Formate le nom de l'utilisateur.
     */
    private function formatName($name)
    {
        if (strpos($name, '-') !== false) {
            return substr($name, 0, strpos($name, '-'));
        }
        return $name;
    }
}
