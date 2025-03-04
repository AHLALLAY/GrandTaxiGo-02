<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Formulaire de connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100 dark:bg-gray-900 min-h-screen">
    <!-- Header Section avec animation subtile et ombre -->
    <header class="bg-gradient-to-r from-indigo-700 to-indigo-500 text-white py-4 shadow-lg fixed top-0 left-0 w-full z-50">
        <div class="container mx-auto flex justify-between items-center px-6">
            <div class="flex items-center">
                <i class="fas fa-taxi text-yellow-300 text-2xl mr-2"></i>
                <h1 class="text-3xl font-bold">GrandTaxiGo</h1>
            </div>
            <nav class="hidden md:flex items-center space-x-6">
                <a href="{{ route('registerForm') }}" class="text-white bg-indigo-800 hover:bg-indigo-900 py-2 px-4 rounded-lg transition duration-300">
                    <i class="fas fa-user-plus mr-2"></i>S'inscrire
                </a>
                <a href="/" class="text-indigo-700 bg-white hover:bg-gray-100 py-2 px-4 rounded-lg transition duration-300">
                    <i class="fas fa-home mr-2"></i>Home
                </a>
            </nav>
            <!-- Menu hamburger pour mobile -->
            <div class="md:hidden">
                <button id="menuButton" class="text-white">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>

        <!-- Menu mobile -->
        <div id="mobileMenu" class="hidden bg-indigo-800 md:hidden">
            <div class="container mx-auto px-6 py-4">
                <div class="mt-4 flex space-x-2">
                    <a href="/register" class="text-white bg-indigo-800 hover:bg-indigo-900 py-2 px-4 rounded-lg transition duration-300">
                        <i class="fas fa-user-plus mr-2"></i>S'inscrire
                    </a>
                    <a href="/" class="text-indigo-700 bg-white hover:bg-gray-100 py-2 px-4 rounded-lg transition duration-300">
                        <i class="fas fa-home mr-2"></i>Home
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main content with proper spacing from header -->
    <div class="pt-24 flex items-center justify-center min-h-screen p-4">
        <!-- Formulaire de connexion -->
        <div class="max-w-lg w-full mx-auto py-8 px-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg">
            <form method="POST" action="/login" class="space-y-6">
                @csrf
                <!-- Titre du formulaire -->
                <h2 class="text-3xl font-bold text-center text-indigo-700 dark:text-indigo-500 mb-8">Connexion</h2>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-gray-700 dark:text-gray-300 mb-2">Email</label>
                    <input id="email" class="w-full rounded-lg border border-gray-300 dark:border-gray-600 p-3 bg-white dark:bg-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300" type="email" name="email" required autocomplete="email" />
                    <div class="mt-2 text-red-500"></div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-gray-700 dark:text-gray-300 mb-2">Mot de passe</label>
                    <input id="password" class="w-full rounded-lg border border-gray-300 dark:border-gray-600 p-3 bg-white dark:bg-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300" type="password" name="password" required autocomplete="current-password" />
                    <div class="mt-2 text-red-500"></div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center text-gray-700 dark:text-gray-300">
                        <input type="checkbox" name="remember" class="form-checkbox text-indigo-600">
                        <span class="ml-2">Se souvenir de moi</span>
                    </label>
                    <a href="/forgot-password" class="text-sm text-indigo-600 hover:text-indigo-500">Mot de passe oublié ?</a>
                </div>

                <!-- Submit Section -->
                <div class="flex items-center justify-between mt-8">
                    <a href="/register" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition duration-300">
                        Pas encore inscrit ?
                    </a>

                    <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-md text-white font-semibold transition duration-300 transform hover:scale-105">
                        Se connecter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle mobile menu
        document.getElementById('menuButton').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>

</html>