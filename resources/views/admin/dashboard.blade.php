<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com/"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>GrandTaxiGo Admin Dashboard</title>
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Header Section avec animation subtile et ombre -->
    <header class="bg-gradient-to-r from-indigo-800 to-indigo-600 text-white py-4 shadow-lg fixed w-full z-50">
        <div class="container mx-auto flex justify-between items-center px-6">
            <div class="flex items-center space-x-2">
                <i class="fas fa-taxi text-yellow-300 text-2xl"></i>
                <h1 class="text-3xl font-bold tracking-tight">GrandTaxiGo</h1>
            </div>
            <nav class="hidden md:flex items-center">
                <div class="flex items-center ml-6">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-white bg-red-700 hover:bg-red-800 py-2 px-4 rounded-lg transition duration-300 flex items-center shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                        </button>
                    </form>
                </div>
            </nav>
            <!-- Menu hamburger pour mobile -->
            <div class="md:hidden">
                <button id="menuButton" class="text-white hover:text-indigo-200 transition">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>

        <!-- Menu mobile -->
        <div id="mobileMenu" class="hidden bg-indigo-700 md:hidden transition duration-300 ease-in-out">
            <div class="container mx-auto px-6 py-4 space-y-3">
                <form action="{{ route('logout') }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full text-white bg-red-700 hover:bg-red-800 py-2 px-4 rounded-lg transition duration-300 flex items-center justify-center">
                        <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Layout avec barre latérale et contenu principal -->
    <div class="flex flex-col md:flex-row pt-20">
        <!-- Barre latérale -->
        <aside class="md:w-64 bg-white shadow-md md:min-h-screen md:fixed md:left-0 md:top-20 md:bottom-0 z-40">
            <div class="p-4">
                <!-- Profil utilisateur -->
                <div class="flex flex-col items-center p-4 mb-6 border-b border-gray-200">
                    @if(session()->has('user'))
                    <div class="ring-2 ring-indigo-600 rounded-full mb-3">
                        <img src="{{ asset('storage/' . session('user')->photo) }}" alt="Photo de profil" class="w-16 h-16 rounded-full object-cover">
                    </div>
                    <h4 class="font-semibold text-gray-800">
                        {{ session('user')->name }}
                    </h4>
                    <p class="text-gray-500 text-sm">{{ session('user')->roles }} </p>
                    @endif
                </div>

                <!-- Menu de navigation -->
                <nav class="space-y-2">
                    <a href="{{ route('passenger') }}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-lg font-medium hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                        <i class="fas fa-tachometer-alt text-indigo-600"></i>
                        <span>Tableau de bord</span>
                    </a>

                    <a href="{{ route('bookings') }}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-lg font-medium hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                        <i class="fas fa-ticket-alt text-indigo-600"></i>
                        <span>Mes réservations</span>
                    </a>

                    <a href="" class="flex items-center space-x-3 text-gray-700 p-2 rounded-lg font-medium hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                        <i class="fas fa-search text-indigo-600"></i>
                        <span>Rechercher trajets</span>
                    </a>
                </nav>
            </div>
        </aside>


    </div>

    <script src="{{ asset ('js/mobile_menu.js') }}"></script>
    <script src="{{ asset ('js/routes.js') }}"></script>
</body>

</html>