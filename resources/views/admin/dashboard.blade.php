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
                </nav>
            </div>
        </aside>

        <!-- Contenu principal -->
        <main class="md:ml-64 flex-grow p-6">
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-tachometer-alt text-indigo-600 mr-2"></i>
                    Tableau de Bord Passager
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Statistiques -->
                    <div class="bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-lg shadow-lg p-4 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-indigo-200 text-sm">Voyages</p>
                                <h3 class="text-3xl font-bold">16</h3>
                            </div>
                            <div class="bg-indigo-500 rounded-full p-3">
                                <i class="fas fa-route text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-green-600 to-green-700 rounded-lg shadow-lg p-4 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-green-200 text-sm">Économies</p>
                                <h3 class="text-3xl font-bold">420 DH</h3>
                            </div>
                            <div class="bg-green-500 rounded-full p-3">
                                <i class="fas fa-coins text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg shadow-lg p-4 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-blue-200 text-sm">Conducteurs</p>
                                <h3 class="text-3xl font-bold">9</h3>
                            </div>
                            <div class="bg-blue-500 rounded-full p-3">
                                <i class="fas fa-user-tie text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-amber-600 to-amber-700 rounded-lg shadow-lg p-4 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-amber-200 text-sm">Réservations actives</p>
                                <h3 class="text-3xl font-bold">2</h3>
                            </div>
                            <div class="bg-amber-500 rounded-full p-3">
                                <i class="fas fa-calendar-check text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions principales -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-search-location text-indigo-600 mr-2"></i>
                        Trouver un trajet
                    </h3>
                    <div class="space-y-4">
                        <form action="" method="post">
                            @csrf
                            <div class="mb-4">
                                <label for="depart" class="block text-sm font-medium text-gray-700">Départ</label>
                                <select name="depart" id="depart" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="default">Sélectionnez une ville de départ</option>
                                    <?php
                                    $villesMaroc = ["Agadir","Al Hoceïma","Azrou","Beni Mellal","Berkane","Casablanca",
                                                    "Chefchaouen","El Jadida","Errachidia","Essaouira","Fès","Guelmim",
                                                    "Ifrane","Kenitra","Khouribga","Laâyoune","Marrakech","Meknès",
                                                    "Mohammédia","Nador","Ouarzazate","Oujda","Rabat","Safi","Salé",
                                                    "Settat","Tanger","Taza","Tétouan","Tiznit"
                                                    ];
                                    foreach ($villesMaroc as $ville) {
                                        echo "<option value='$ville'>$ville</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="destination" class="block text-sm font-medium text-gray-700">Destination</label>
                                <select name="destination" id="destination" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="default">Sélectionnez une ville de destination</option>
                                    <?php
                                    foreach ($villesMaroc as $ville) {
                                        echo "<option value='$ville'>$ville</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="date" class="block text-sm font-medium text-gray-700">Date du voyage</label>
                                <input type="date" name="date" id="date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                            <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <i class="fas fa-search mr-2"></i>Rechercher
                            </button>
                        </form>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-bookmark text-indigo-600 mr-2"></i>
                        Mes réservations
                    </h3>
                    <div class="space-y-4">
                        <div class="bg-indigo-50 rounded-lg p-4 border border-indigo-100">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-semibold text-gray-800">Casablanca → Marrakech</h4>
                                    <p class="text-sm text-gray-600"><i class="far fa-calendar mr-1"></i> 15 Mars 2025, 08:30</p>
                                    <p class="text-sm text-gray-600"><i class="fas fa-user-tie mr-1"></i> Mohamed A.</p>
                                </div>
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Confirmé</span>
                            </div>
                        </div>
                        <div class="bg-indigo-50 rounded-lg p-4 border border-indigo-100">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-semibold text-gray-800">Rabat → Tanger</h4>
                                    <p class="text-sm text-gray-600"><i class="far fa-calendar mr-1"></i> 22 Mars 2025, 14:00</p>
                                    <p class="text-sm text-gray-600"><i class="fas fa-user-tie mr-1"></i> Karim B.</p>
                                </div>
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">En attente</span>
                            </div>
                        </div>
                        <form action="{{ route('bookings') }}">
                            <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                <i class="fas fa-list-ul mr-2"></i>
                                Voir toutes mes réservations
                            </button>
                        </form>
                    </div>
                </div>
            </div>            
        </main>
    </div>

    <script src="{{ asset ('js/mobile_menu.js') }}"></script>
    <script src="{{ asset ('js/routes.js') }}"></script>
</body>

</html>