<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com/"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>GrandTaxiGo Dashboard</title>
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
                        @elseif(session()->has('driver'))
                        <img src="{{ asset('storage/' . session('driver')->photo) }}" alt="Photo du chauffeur" class="w-16 h-16 rounded-full object-cover">
                        @else
                        <img src="{{ asset('images/default-avatar.png') }}" alt="Photo par défaut" class="w-16 h-16 rounded-full object-cover">
                        @endif
                    </div>
                    <h4 class="font-semibold text-gray-800">
                        @if(session()->has('user')) {{ session('user')->name }} @else {{ session('driver')->name }} @endif
                    </h4>
                    <p class="text-gray-500 text-sm">
                        @if(session()->has('user')) Utilisateur @else Chauffeur @endif
                    </p>
                </div>

                <!-- Menu de navigation -->
                <nav class="space-y-2">
                    <a href="{{ route('driver') }}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-lg font-medium hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                        <i class="fas fa-tachometer-alt text-indigo-600"></i>
                        <span>Tableau de bord</span>
                    </a>

                    <a href="{{ route('routes') }}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-lg font-medium hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                        <i class="fas fa-map-marked-alt text-indigo-600"></i>
                        <span>Mes routes</span>
                    </a>

                    <a href="#" class="flex items-center space-x-3 text-gray-700 p-2 rounded-lg font-medium hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                        <i class="fas fa-calendar-check text-indigo-600"></i>
                        <span>Réservations</span>
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Contenu principal -->
        <main class="md:ml-64 flex-grow p-6">
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-tachometer-alt text-indigo-600 mr-2"></i>
                    Tableau de Bord
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Statistiques -->
                    <div class="bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-lg shadow-lg p-4 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-indigo-200 text-sm">Courses</p>
                                <h3 class="text-3xl font-bold">124</h3>
                            </div>
                            <div class="bg-indigo-500 rounded-full p-3">
                                <i class="fas fa-route text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-green-600 to-green-700 rounded-lg shadow-lg p-4 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-green-200 text-sm">Gains</p>
                                <h3 class="text-3xl font-bold">2560 DH</h3>
                            </div>
                            <div class="bg-green-500 rounded-full p-3">
                                <i class="fas fa-money-bill-wave text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg shadow-lg p-4 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-blue-200 text-sm">Passagers</p>
                                <h3 class="text-3xl font-bold">368</h3>
                            </div>
                            <div class="bg-blue-500 rounded-full p-3">
                                <i class="fas fa-users text-xl"></i>
                            </div> 
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-amber-600 to-amber-700 rounded-lg shadow-lg p-4 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-amber-200 text-sm">Notation</p>
                                <h3 class="text-3xl font-bold">4.8 <span class="text-sm">/ 5</span></h3>
                            </div>
                            <div class="bg-amber-500 rounded-full p-3">
                                <i class="fas fa-star text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions principales -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-map-marked-alt text-indigo-600 mr-2"></i>
                        Gestion des Routes
                    </h3>
                    <div class="space-y-4">
                        <form action="{{ route('newPost') }}" method="post">
                            @csrf
                            <div class="mb-4">
                                <label for="depart" class="block text-sm font-medium text-gray-700">Départ</label>
                                <select name="depart" id="depart" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="default">Sélectionnez une ville de départ</option>
                                    <?php
                                    $villesMaroc = ["Agadir","Al Hoceïma","Azrou","Beni Mellal","Berkane",
                                                    "Casablanca","Chefchaouen","El Jadida","Errachidia",
                                                    "Essaouira","Fès","Guelmim","Ifrane","Kenitra","Khouribga",
                                                    "Laâyoune","Marrakech","Meknès","Mohammédia","Nador",
                                                    "Ouarzazate","Oujda","Rabat","Safi","Salé","Settat","Tanger",
                                                    "Taza","Tétouan","Tiznit"
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
                            <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Add Route
                            </button>
                        </form>

                        <form action="{{ route('routes') }}">
                            <button class="w-full bg-white hover:bg-gray-50 text-indigo-700 font-medium py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center border border-indigo-600 shadow-sm hover:shadow transform hover:-translate-y-0.5">
                                <i class="fas fa-list-ul mr-2"></i>
                                Afficher mes Routes
                            </button>
                        </form>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-bookmark text-indigo-600 mr-2"></i>
                        Réservations
                    </h3>
                    <div class="space-y-4">
                        <form action="">
                            <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                <i class="fas fa-calendar-check mr-2"></i>
                                Afficher Réservations
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal pour ajouter les informations du taxi -->
    <div id="taxiModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Ajouter les informations du taxi</h3>
            <form action="{{ route('newTaxi') }}" method="post" id="taxiForm">
                @csrf
                <div class="mb-4">
                    <label for="taxiModel" class="block text-sm font-medium text-gray-700">Modèle du taxi</label>
                    <input type="text" id="taxiModel" name="taxiModel" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="taxiPlate" class="block text-sm font-medium text-gray-700">Plaque d'immatriculation</label>
                    <input type="text" id="taxiPlate" name="taxiPlate" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeTaxiModal()" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition duration-300">Annuler</button>
                    <button type="submit" class="ml-2 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal pour modifier les informations du taxi -->
    <div id="updateTaxiModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Modifier les informations du taxi</h3>
            <form action="{{ route('updateTaxi') }}" method="post" id="updateTaxiForm">
                @csrf
                <div class="mb-4">
                    <label for="taxiModel" class="block text-sm font-medium text-gray-700">Modèle du taxi</label>
                    <input type="text" id="taxiModel" name="newTaxiModel" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="taxiPlate" class="block text-sm font-medium text-gray-700">Plaque d'immatriculation</label>
                    <input type="text" id="taxiPlate" name="newTaxiPlate" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeUpdateTaxiModal()" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition duration-300">Annuler</button>
                    <button type="submit" class="ml-2 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300">Modifier</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Section pour afficher les informations du taxi -->
    <div class="md:ml-64 flex-grow p-6">
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-taxi text-yellow-500 mr-2"></i>Informations du taxi
                </h2>
                <button onclick="handleTaxiModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                    <i class="fas fa-edit mr-2"></i>
                    @if(session()->has('driver') && $taxi->isNotEmpty())
                        Modifier
                    @else
                        Ajouter
                    @endif
                </button>
            </div>
            <div id="taxiInfo" class="text-gray-700">
                @if(session()->has('driver') && $taxi->isNotEmpty())
                    @foreach($taxi as $t)
                        <p><strong>Modèle:</strong> {{ $t->brand }}</p>
                        <p><strong>Plaque d'immatriculation:</strong> {{ $t->registration }}</p>
                    @endforeach
                @else
                    <p>Aucune information de taxi disponible.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Script pour le menu mobile -->
    <script src="{{ asset('js/gestionnaire_des_modals.js') }}"></script>
    <script src="{{ asset ('js/route.js') }}"></script>
</body>

</html>