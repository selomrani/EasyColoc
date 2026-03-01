<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>EasyColoc — La colocation simplifiée</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
        @endif
    </head>
    <body class="antialiased font-sans bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
        
        <div class="relative min-h-screen flex flex-col selection:bg-indigo-500 selection:text-white">
            
            <!-- Navigation (Glass effect fixed on all screens) -->
            @if (Route::has('login'))
                <header class="fixed top-0 left-0 right-0 py-4 px-6 z-50 w-full flex justify-between items-center bg-gray-100/70 dark:bg-gray-900/70 backdrop-blur-md border-b border-gray-200/50 dark:border-gray-800/50 transition-all">
                    <div class="flex items-center gap-2">
                        <!-- Simple Logo icon -->
                        <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="font-bold text-xl tracking-tight text-gray-800 dark:text-gray-200">EasyColoc</span>
                    </div>

                    <nav class="space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500 transition-colors">Tableau de bord</a>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500 transition-colors">Connexion</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-2 sm:ml-4">
                                    S'inscrire
                                </a>
                            @endif
                        @endauth
                    </nav>
                </header>
            @endif

            <!-- Contenu Principal (pt-32 évite que la nav mange le contenu) -->
            <main class="flex-grow flex items-center justify-center p-6 lg:p-8 pt-32 pb-16">
                <div class="max-w-7xl mx-auto w-full">
                    
                    <!-- Hero Section -->
                    <div class="text-center max-w-3xl mx-auto mb-16">
                        <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 dark:text-white mb-6 tracking-tight leading-tight">
                            Gérez votre colocation <br/>
                            <span class="text-indigo-600 dark:text-indigo-400">sans prise de tête</span>
                        </h1>
                        <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 leading-relaxed">
                            Fini les fichiers Excel compliqués et les discussions tendues à la fin du mois. 
                            EasyColoc suit vos dépenses communes et calcule automatiquement qui doit quoi à qui.
                        </p>
                        <div class="flex flex-col sm:flex-row justify-center gap-4">
                            @guest
                                <a href="{{ route('register') }}" class="inline-flex justify-center items-center px-6 py-3 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-base text-white dark:text-gray-800 hover:bg-gray-700 dark:hover:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    Créer une colocation
                                </a>
                                <a href="{{ route('login') }}" class="inline-flex justify-center items-center px-6 py-3 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-base text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    Rejoindre une colocation
                                </a>
                            @else
                                <a href="{{ url('/dashboard') }}" class="inline-flex justify-center items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-base text-white hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    Accéder à mon espace
                                </a>
                            @endguest
                        </div>
                    </div>

                    <!-- Features Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                        
                        <!-- Feature 1 -->
                        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                            <div class="w-10 h-10 flex items-center justify-center rounded-md bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Dépenses partagées</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                Ajoutez facilement vos courses, factures ou loyers. Catégorisez vos achats et gardez un historique clair pour tout le monde.
                            </p>
                        </div>

                        <!-- Feature 2 -->
                        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                            <div class="w-10 h-10 flex items-center justify-center rounded-md bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Calcul automatique</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                L'algorithme simplifie les dettes croisées. Une vue simple vous indique exactement qui doit rembourser qui, avec le moins de transactions possible.
                            </p>
                        </div>

                        <!-- Feature 3 -->
                        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                            <div class="w-10 h-10 flex items-center justify-center rounded-md bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Système de réputation</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                Récompensez les bons payeurs. Les membres qui quittent en règle gagnent en réputation, favorisant un environnement de confiance.
                            </p>
                        </div>

                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="py-6 text-center text-sm text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-800 mt-auto bg-gray-50 dark:bg-gray-900/50">
                &copy; {{ date('Y') }} EasyColoc. Construit avec Laravel.
            </footer>
        </div>
    </body>
</html>