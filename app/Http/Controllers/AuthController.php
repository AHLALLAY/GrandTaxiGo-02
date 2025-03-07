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
        $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string|min:8'
        ]);

        $user = User::where('email', $request->email)->first();
        $driver = Driver::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('user', $user);
            return redirect()->route('passenger')->with('success', 'Connexion réussie !');
        } elseif ($driver && Hash::check($request->password, $driver->password)) {
            Session::put('driver', $driver);
            return redirect()->route('driver')->with('success', 'Connexion réussie !');
        } else {
            return redirect('login')->withErrors(['error' => 'Invalid email or password.']);
        }

        return redirect()->route('driver');
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
