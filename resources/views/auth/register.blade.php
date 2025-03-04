<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Formulaire d'inscription</title>
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
                <a href="login" class="text-white bg-indigo-800 hover:bg-indigo-900 py-2 px-4 rounded-lg transition duration-300">
                    <i class="fas fa-user mr-2"></i>Connexion
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
                    <form action="login" method="get">
                        <a href="login" class="text-white bg-indigo-800 hover:bg-indigo-900 py-2 px-4 rounded-lg transition duration-300">
                            <i class="fas fa-user mr-2"></i>Connexion
                        </a>
                    </form>
                    <form action="register" method="get">
                        <a href="register" class="text-indigo-700 bg-white hover:bg-gray-100 py-2 px-4 rounded-lg transition duration-300">
                            <i class="fas fa-user-plus mr-2"></i>S'inscrire
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main content with proper spacing from header -->
    <div class="pt-24 flex items-center justify-center min-h-screen p-4">
        <!-- Formulaire d'inscription -->
        <div class="max-w-lg w-full mx-auto py-8 px-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg">
            <form method="POST" action="{{ route('registerAction') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <!-- Photo Section -->
                <div class="flex justify-center mb-6">
                    <div class="text-center">
                        <div class="relative mx-auto w-36 h-36 mb-3">
                            <div class="w-36 h-36 rounded-full bg-gray-200 dark:bg-gray-700 border-4 border-white dark:border-gray-800 overflow-hidden flex items-center justify-center shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div id="photo-placeholder" class="text-gray-500 dark:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <img id="preview-image" src="#" alt="Profile" class="w-full h-full object-cover hidden rounded-full">
                            </div>

                            <!-- Upload Button -->
                            <label for="photo" class="absolute -bottom-2 -right-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full p-2 cursor-pointer shadow-lg transform hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </label>
                        </div>

                        <input id="photo" name="photo" type="file" class="hidden" accept="image/*" onchange="previewPhoto(this)">
                        
                        <div class="mt-2 text-red-500"></div>
                    </div>
                </div>

                <!-- Personal Information Section -->
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-gray-700 dark:text-gray-300 mb-2">Name</label>
                            <input id="name" class="w-full rounded-lg border border-gray-300 dark:border-gray-600 p-3 bg-white dark:bg-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300" type="text" name="name" required autofocus autocomplete="name" />
                            <div class="mt-2 text-red-500"></div>
                        </div>

                        <!-- Role Selection -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 mb-2">Role</label>
                            <div class="flex items-center space-x-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-300 dark:border-gray-600">
                                <label class="flex items-center text-gray-700 dark:text-gray-300">
                                    <input type="radio" id="passenger" name="role" value="passenger" class="form-radio text-indigo-600">
                                    <span class="ml-2">Passenger</span>
                                </label>
                                <label class="flex items-center text-gray-700 dark:text-gray-300">
                                    <input type="radio" id="driver" name="role" value="driver" class="form-radio text-indigo-600">
                                    <span class="ml-2">Driver</span>
                                </label>
                            </div>
                            <div class="mt-2 text-red-500"></div>
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-gray-700 dark:text-gray-300 mb-2">Email</label>
                        <input id="email" class="w-full rounded-lg border border-gray-300 dark:border-gray-600 p-3 bg-white dark:bg-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300" type="email" name="email" required autocomplete="username" />
                        <div class="mt-2 text-red-500"></div>
                    </div>

                    <!-- Password Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-gray-700 dark:text-gray-300 mb-2">Password</label>
                            <input id="password" class="w-full rounded-lg border border-gray-300 dark:border-gray-600 p-3 bg-white dark:bg-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300" type="password" name="password" required autocomplete="new-password" />
                            <div class="mt-2 text-red-500"></div>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-gray-700 dark:text-gray-300 mb-2">Confirm Password</label>
                            <input id="password_confirmation" class="w-full rounded-lg border border-gray-300 dark:border-gray-600 p-3 bg-white dark:bg-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300" type="password" name="password_confirmation" required autocomplete="new-password" />
                            <div class="mt-2 text-red-500"></div>
                        </div>
                    </div>
                </div>

                <!-- Submit Section -->
                <div class="flex items-center justify-between mt-8">
                    <a href="/login" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition duration-300">
                        Already registered?
                    </a>

                    <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-md text-white font-semibold transition duration-300 transform hover:scale-105">
                        Register
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

        function previewPhoto(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    const preview = document.getElementById('preview-image');
                    const placeholder = document.getElementById('photo-placeholder');

                    preview.setAttribute('src', e.target.result);
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>