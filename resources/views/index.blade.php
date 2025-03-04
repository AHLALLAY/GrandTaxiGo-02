<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation Grand Taxi - Maroc</title>
    <!-- Intégration de TailwindCSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans text-gray-900">

    <!-- Header Section avec animation subtile et ombre -->
    <header class="bg-gradient-to-r from-indigo-700 to-indigo-500 text-white py-4 shadow-lg fixed w-full z-50">
        <div class="container mx-auto flex justify-between items-center px-6">
            <div class="flex items-center">
                <i class="fas fa-taxi text-yellow-300 text-2xl mr-2"></i>
                <h1 class="text-3xl font-bold">GrandTaxiGo</h1>
            </div>
            <nav class="hidden md:flex items-center space-x-6">
                <div class="flex space-x-6">
                    <a href="#services" class="text-white hover:text-yellow-300 transition duration-300">Services</a>
                    <a href="#destinations" class="text-white hover:text-yellow-300 transition duration-300">Destinations</a>
                    <a href="#tarifs" class="text-white hover:text-yellow-300 transition duration-300">Tarifs</a>
                    <a href="#contact" class="text-white hover:text-yellow-300 transition duration-300">Contact</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('loginForm') }}" class="text-white bg-indigo-800 hover:bg-indigo-900 py-2 px-4 rounded-lg transition duration-300">
                        <i class="fas fa-user mr-2"></i>Connexion
                    </a>
                    <a href="{{ route('registerForm') }}" class="text-indigo-700 bg-white hover:bg-gray-100 py-2 px-4 rounded-lg transition duration-300">
                        <i class="fas fa-user-plus mr-2"></i>S'inscrire
                    </a>
                </div>
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
                <a href="#services" class="block text-white py-2">Services</a>
                <a href="#destinations" class="block text-white py-2">Destinations</a>
                <a href="#tarifs" class="block text-white py-2">Tarifs</a>
                <a href="#contact" class="block text-white py-2">Contact</a>
                <div class="mt-4 flex space-x-2">
                    <a href="login" class="block text-white bg-indigo-900 py-2 px-4 rounded-lg text-center w-1/2">
                        <i class="fas fa-user mr-2"></i>Connexion
                    </a>
                    <a href="register" class="block text-indigo-700 bg-white py-2 px-4 rounded-lg text-center w-1/2">
                        <i class="fas fa-user-plus mr-2"></i>S'inscrire
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Hero Section with enhanced visuals -->
    <div class="bg-cover bg-center h-screen relative pt-16" style="background-image: url('/api/placeholder/1200/800');">
        <div class="absolute inset-0 bg-gradient-to-b from-indigo-900/70 to-black/80"></div>
        <div class="container mx-auto text-center text-white relative z-10 h-full flex flex-col justify-center px-6">
            <span class="inline-block mx-auto bg-yellow-500 text-indigo-900 font-bold px-4 py-1 rounded-full text-sm mb-4">Service 24/7 dans tout le Maroc</span>
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">Votre Taxi Grand Confort<br>Vous Attend !</h2>
            <p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto">Réservez un grand taxi pour vos trajets dans tout le Maroc, en toute simplicité et sécurité. Prix fixe, chauffeurs professionnels.</p>

            <!-- Formulaire de réservation rapide -->
            <div id="reservation" class="bg-white/10 backdrop-blur-md p-6 rounded-xl max-w-3xl mx-auto">
                <h3 class="text-2xl font-semibold mb-4">Réservation Rapide</h3>
                <form class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-left text-sm mb-1">Départ</label>
                        <select class="w-full bg-white/90 text-gray-800 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option>Casablanca</option>
                            <option>Marrakech</option>
                            <option>Rabat</option>
                            <option>Fès</option>
                            <option>Tanger</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-left text-sm mb-1">Destination</label>
                        <select class="w-full bg-white/90 text-gray-800 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option>Marrakech</option>
                            <option>Casablanca</option>
                            <option>Rabat</option>
                            <option>Fès</option>
                            <option>Tanger</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-left text-sm mb-1">Date</label>
                        <input type="date" class="w-full bg-white/90 text-gray-800 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div class="md:col-span-3">
                        <button class="bg-yellow-500 hover:bg-yellow-600 text-indigo-900 font-bold py-3 px-6 rounded-lg w-full md:w-auto transition duration-300 transform hover:scale-105">
                            <i class="fas fa-search mr-2"></i>Rechercher un Taxi
                        </button>
                    </div>
                </form>
            </div>

            <!-- Avantages rapides -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-12">
                <div class="bg-indigo-800/50 backdrop-blur-sm p-4 rounded-lg">
                    <i class="fas fa-money-bill-wave text-yellow-400 text-2xl mb-2"></i>
                    <h4 class="font-medium">Prix Fixe</h4>
                </div>
                <div class="bg-indigo-800/50 backdrop-blur-sm p-4 rounded-lg">
                    <i class="fas fa-shield-alt text-yellow-400 text-2xl mb-2"></i>
                    <h4 class="font-medium">Sécurité Garantie</h4>
                </div>
                <div class="bg-indigo-800/50 backdrop-blur-sm p-4 rounded-lg">
                    <i class="fas fa-clock text-yellow-400 text-2xl mb-2"></i>
                    <h4 class="font-medium">24/7 Disponible</h4>
                </div>
                <div class="bg-indigo-800/50 backdrop-blur-sm p-4 rounded-lg">
                    <i class="fas fa-star text-yellow-400 text-2xl mb-2"></i>
                    <h4 class="font-medium">Chauffeurs Pro</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact et Newsletter (Suite) -->
    <section id="contact" class="py-16 bg-indigo-700 text-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <h2 class="text-3xl font-bold mb-6">Contactez-nous</h2>
                    <p class="mb-8">Notre équipe est à votre disposition pour répondre à toutes vos questions et vous aider à organiser vos déplacements dans les meilleures conditions.</p>

                    <div class="flex items-center mb-4">
                        <i class="fas fa-phone-alt text-yellow-300 text-xl w-8"></i>
                        <span>+212 5XX-XXXXXX</span>
                    </div>

                    <div class="flex items-center mb-4">
                        <i class="fas fa-envelope text-yellow-300 text-xl w-8"></i>
                        <span>contact@grandtaxigo.ma</span>
                    </div>

                    <div class="flex items-center mb-6">
                        <i class="fas fa-map-marker-alt text-yellow-300 text-xl w-8"></i>
                        <span>123 Boulevard Mohammed V, Casablanca, Maroc</span>
                    </div>

                    <div class="flex space-x-4">
                        <a href="#" class="bg-indigo-600 hover:bg-indigo-800 w-10 h-10 rounded-full flex items-center justify-center transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="bg-indigo-600 hover:bg-indigo-800 w-10 h-10 rounded-full flex items-center justify-center transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="bg-indigo-600 hover:bg-indigo-800 w-10 h-10 rounded-full flex items-center justify-center transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="bg-indigo-600 hover:bg-indigo-800 w-10 h-10 rounded-full flex items-center justify-center transition duration-300">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h2 class="text-3xl font-bold mb-6">Newsletter</h2>
                    <p class="mb-8">Inscrivez-vous à notre newsletter pour recevoir nos offres spéciales et actualités.</p>

                    <form>
                        <div class="flex flex-col mb-4">
                            <label class="mb-2 font-medium">Votre nom</label>
                            <input type="text" class="bg-indigo-600 border border-indigo-500 text-white px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-300 placeholder-indigo-300" placeholder="Entrez votre nom">
                        </div>

                        <div class="flex flex-col mb-4">
                            <label class="mb-2 font-medium">Votre email</label>
                            <input type="email" class="bg-indigo-600 border border-indigo-500 text-white px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-300 placeholder-indigo-300" placeholder="Entrez votre email">
                        </div>

                        <div class="flex items-center mb-6">
                            <input type="checkbox" id="conditions" class="mr-2">
                            <label for="conditions" class="text-sm">J'accepte de recevoir des emails de GrandTaxiGo</label>
                        </div>

                        <button class="bg-yellow-500 hover:bg-yellow-600 text-indigo-900 font-bold py-3 px-6 rounded-lg w-full transition duration-300">
                            S'inscrire
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Section tarifs -->
    <section id="tarifs" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-indigo-700 mb-2">Nos Tarifs</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Des prix fixes et transparents pour tous vos trajets.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200 transition duration-300 hover:shadow-xl">
                    <div class="bg-indigo-100 p-6 text-center">
                        <h3 class="text-2xl font-bold text-indigo-800 mb-1">Trajet Simple</h3>
                        <p class="text-indigo-600">Place Individuelle</p>
                    </div>
                    <div class="p-6">
                        <ul class="mb-6 space-y-3">
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Prix par personne</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Départs réguliers</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>1 bagage inclus</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-times text-red-500 mr-2"></i>
                                <span class="text-gray-500">Pas de réservation de véhicule entier</span>
                            </li>
                        </ul>
                        <div class="text-center">
                            <span class="text-4xl font-bold text-indigo-700">À partir de 80 DH</span>
                            <span class="text-gray-600 block mt-1">par personne</span>
                        </div>
                        <button class="mt-6 w-full bg-indigo-700 hover:bg-indigo-800 text-white py-3 rounded-lg transition duration-300">
                            Voir les trajets
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-xl overflow-hidden border-2 border-indigo-600 transform scale-105 relative z-10">
                    <div class="absolute top-0 right-0 bg-yellow-500 text-indigo-900 font-bold py-1 px-4 text-sm">
                        POPULAIRE
                    </div>
                    <div class="bg-indigo-700 p-6 text-center text-white">
                        <h3 class="text-2xl font-bold mb-1">Taxi Privé</h3>
                        <p class="text-indigo-200">Véhicule Complet</p>
                    </div>
                    <div class="p-6">
                        <ul class="mb-6 space-y-3">
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Taxi réservé pour vous</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Horaire à votre convenance</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Jusqu'à 6 personnes</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Bagages inclus</span>
                            </li>
                        </ul>
                        <div class="text-center">
                            <span class="text-4xl font-bold text-indigo-700">À partir de 450 DH</span>
                            <span class="text-gray-600 block mt-1">par véhicule</span>
                        </div>
                        <button class="mt-6 w-full bg-yellow-500 hover:bg-yellow-600 text-indigo-900 font-bold py-3 rounded-lg transition duration-300">
                            Réserver maintenant
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200 transition duration-300 hover:shadow-xl">
                    <div class="bg-indigo-100 p-6 text-center">
                        <h3 class="text-2xl font-bold text-indigo-800 mb-1">Excursion</h3>
                        <p class="text-indigo-600">Journée Complète</p>
                    </div>
                    <div class="p-6">
                        <ul class="mb-6 space-y-3">
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Circuit touristique</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Chauffeur-guide</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Arrêts photos illimités</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Jusqu'à 6 personnes</span>
                            </li>
                        </ul>
                        <div class="text-center">
                            <span class="text-4xl font-bold text-indigo-700">À partir de 900 DH</span>
                            <span class="text-gray-600 block mt-1">par journée</span>
                        </div>
                        <button class="mt-6 w-full bg-indigo-700 hover:bg-indigo-800 text-white py-3 rounded-lg transition duration-300">
                            Découvrir les excursions
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-indigo-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="mb-6 md:mb-0">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-taxi text-yellow-300 text-2xl mr-2"></i>
                        <h3 class="text-xl font-bold">GrandTaxiGo</h3>
                    </div>
                    <p class="text-indigo-200 mb-4">Le moyen le plus simple et sécurisé de voyager en Grand Taxi partout au Maroc.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-indigo-300 hover:text-white">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-indigo-300 hover:text-white">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-indigo-300 hover:text-white">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-indigo-300 hover:text-white">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-4">Liens Rapides</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-indigo-300 hover:text-white">Accueil</a></li>
                        <li><a href="#services" class="text-indigo-300 hover:text-white">Services</a></li>
                        <li><a href="#destinations" class="text-indigo-300 hover:text-white">Destinations</a></li>
                        <li><a href="#tarifs" class="text-indigo-300 hover:text-white">Tarifs</a></li>
                        <li><a href="#contact" class="text-indigo-300 hover:text-white">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-4">Légal</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-indigo-300 hover:text-white">Conditions d'utilisation</a></li>
                        <li><a href="#" class="text-indigo-300 hover:text-white">Politique de confidentialité</a></li>
                        <li><a href="#" class="text-indigo-300 hover:text-white">Cookies</a></li>
                        <li><a href="#" class="text-indigo-300 hover:text-white">Mentions légales</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-4">Application Mobile</h3>
                    <p class="text-indigo-300 mb-4">Téléchargez notre application pour une expérience encore plus fluide.</p>
                    <div class="flex flex-col space-y-2">
                        <a href="#" class="bg-white/10 hover:bg-white/20 py-2 px-4 rounded-lg flex items-center">
                            <i class="fab fa-apple text-xl mr-3"></i>
                            <div>
                                <div class="text-xs text-indigo-300">Télécharger sur</div>
                                <div class="font-semibold">App Store</div>
                            </div>
                        </a>
                        <a href="#" class="bg-white/10 hover:bg-white/20 py-2 px-4 rounded-lg flex items-center">
                            <i class="fab fa-google-play text-xl mr-3"></i>
                            <div>
                                <div class="text-xs text-indigo-300">Télécharger sur</div>
                                <div class="font-semibold">Google Play</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-indigo-800 mt-12 pt-8 text-center text-indigo-400 text-sm">
                <p>&copy; 2025 GrandTaxiGo - Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript pour le menu mobile -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.getElementById('menuButton');
            const mobileMenu = document.getElementById('mobileMenu');

            menuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        });
    </script>
</body>

</html>