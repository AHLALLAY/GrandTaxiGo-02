<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com/"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>GrandTaxiGo Passenger Dashboard</title>
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
                    <div class="ring-2 ring-indigo-600 rounded-full mb-3">
                        @if(session()->has('user'))
                        <img src="{{ asset('storage/' . session('user')->photo) }}" alt="Photo de l'utilisateur" class="w-16 h-16 rounded-full object-cover">
                        @else
                        <img src="{{ asset('images/default-avatar.png') }}" alt="Photo par défaut" class="w-16 h-16 rounded-full object-cover">
                        @endif
                    </div>
                    <h4 class="font-semibold text-gray-800">
                        @if(session()->has('user')) {{ session('user')->name }} @endif
                    </h4>
                    <p class="text-gray-500 text-sm">Passager</p>
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

                    <div class="pt-2 border-t border-gray-200 mt-2">
                        <a href="" class="flex items-center space-x-3 text-gray-700 p-2 rounded-lg font-medium hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                            <i class="fas fa-user-circle text-indigo-600"></i>
                            <span>Mon profil</span>
                        </a>
                    </div>
                </nav>
            </div>
        </aside>

        <!-- Contenu principal -->
        <main class="md:ml-64 flex-grow p-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Chauffeurs disponibles</h2>

                @if($availableDrivers->isEmpty())
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <i class="fas fa-car text-gray-300 text-4xl mb-3"></i>
                    <p class="text-lg font-medium text-gray-700">Aucun chauffeur disponible pour le moment.</p>
                    <p class="text-sm text-gray-500">Veuillez réessayer plus tard.</p>
                </div>
                @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($availableDrivers as $driver)
                    <form action="{{ route('bookings') }}" method="post">
                        @csrf
                        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                            <div class="flex items-center space-x-4">
                                <div class="ring-2 ring-indigo-600 rounded-full">
                                    <img src="{{ asset('storage/' . $driver->driver_photo) }}" alt="Photo du chauffeur" class="w-16 h-16 rounded-full object-cover">
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">{{ $driver->driver_name }}</h4>
                                    <p class="text-sm text-gray-500">{{ $driver->taxi_brand }} ({{ $driver->taxi_registration }})</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-map-marker-alt text-blue-500"></i> Dernière route : {{ $driver->last_depart }} → {{ $driver->last_destination }}
                                </p>
                            </div>
                            <div class="mt-4">
                                <input type="hidden" name="driver_id" value="{{ $driver->driver_id }}">
                                <input type="hidden" name="route_id" value="{{ $driver->route_id }}">
                                <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-200">
                                    <i class="fas fa-car mr-2"></i> Réserver
                                </button>
                            </div>
                        </div>
                    </form>
                    @endforeach
                </div>
                @endif
            </div>
        </main>
    </div>

    <!-- Script pour le menu mobile -->
    <script>
        document.getElementById('menuButton').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('hidden');
        });
    </script>
    <script src="{{ asset ('js/routes.js') }}"></script>
</body>

</html>