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

                    <div class="pt-2 border-t border-gray-200 mt-2">
                        <a href="#" class="flex items-center space-x-3 text-gray-700 p-2 rounded-lg font-medium hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                            <i class="fas fa-taxi text-yellow-500"></i>
                            <span>Info du taxi</span>
                        </a>
                    </div>
                </nav>
            </div>
        </aside>

        <!-- Contenu principal -->
        <main class="md:ml-64 flex-grow p-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <!-- Ajouter une routes -->
                <div class="space-y-4">
                <form action="{{ route('newPost') }}" method="post" class="p-6 bg-white rounded-lg shadow-md">
                    @csrf
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Nouvel itinéraire</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <!-- Ville de départ -->
                        <div>
                            <label for="depart" class="block text-sm font-medium text-gray-700 mb-1">Ville de départ</label>
                            <select name="depart" id="depart" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 
                                        bg-white text-gray-800">
                                <option value="default" disabled selected>Sélectionnez une ville de départ</option>
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

                        <!-- Ville de destination -->
                        <div>
                            <label for="destination" class="block text-sm font-medium text-gray-700 mb-1">Ville de destination</label>
                            <select name="destination" id="destination" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 
                                        bg-white text-gray-800">
                                <option value="default" disabled selected>Sélectionnez une ville de destination</option>
                                <?php
                                foreach ($villesMaroc as $ville) {
                                    echo "<option value='$ville'>$ville</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Bouton de soumission -->
                    <button type="submit" 
                            class="w-full py-2 px-4 bg-blue-600 text-white font-medium rounded-md 
                                hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 
                                focus:ring-offset-2 transition-colors duration-200">
                        Ajouter cet itinéraire
                    </button>
                </form>
                    </div>
                </div>

                <!-- Tableau des routes -->
                <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-800">Mes Routes</h2>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Départ</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Destination</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de création</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if(isset($routes) && $routes->isEmpty())
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <i class="fas fa-route text-gray-300 text-4xl mb-3"></i>
                                            <p class="text-lg font-medium">Aucune route trouvée</p>
                                            <p class="text-sm text-gray-400">Créez votre première route en utilisant le formulaire ci-dessus</p>
                                        </div>
                                    </td>
                                </tr>
                                @elseif(isset($routes))
                                @php
                                $maxId = $routes->max('id');
                                @endphp
                                @foreach($routes as $route)
                                <tr class="{{ $route->id == $maxId ? 'bg-green-50 hover:bg-green-100' : 'hover:bg-gray-50' }} transition duration-150">
                                    <td class="py-4 px-4 text-sm {{ $route->id == $maxId ? 'text-green-700 font-semibold' : 'text-gray-700' }}">{{ $route->id }}</td>
                                    <td class="py-4 px-4 text-sm {{ $route->id == $maxId ? 'text-green-700' : 'text-gray-700' }}">
                                        <div class="flex items-center">
                                            <i class="fas fa-map-marker-alt mr-2 {{ $route->id == $maxId ? 'text-green-500' : 'text-blue-500' }}"></i>
                                            {{ $route->depart }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-sm {{ $route->id == $maxId ? 'text-green-700' : 'text-gray-700' }}">
                                        <div class="flex items-center">
                                            <i class="fas fa-flag-checkered mr-2 {{ $route->id == $maxId ? 'text-green-500' : 'text-blue-500' }}"></i>
                                            {{ $route->destination }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-sm {{ $route->id == $maxId ? 'text-green-700' : 'text-gray-700' }}">
                                        <div class="flex items-center">
                                            <i class="far fa-calendar mr-2 {{ $route->id == $maxId ? 'text-green-500' : 'text-gray-400' }}"></i>
                                            {{ $route->created_at }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-sm text-gray-700">
                                        <div class="flex space-x-2">
                                            <button class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-150 flex items-center">
                                                <i class="fas fa-edit mr-1"></i> Modifier
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
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

    <script src="{{ asset ('js/route.js') }}"></script>
</body>

</html>