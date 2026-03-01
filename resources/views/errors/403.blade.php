<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>403 - Accès Refusé | EasyColoc</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
        @endif
    </head>
    <body class="antialiased font-sans bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex items-center justify-center min-h-screen selection:bg-indigo-500 selection:text-white">
        
        <div class="max-w-xl mx-auto px-6 py-12 text-center">
            
            <!-- Icône de sécurité/blocage -->
            <div class="flex justify-center mb-6">
                <div class="p-3 bg-red-100 dark:bg-red-900/20 rounded-full">
                    <svg class="w-12 h-12 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>

            <!-- Code et Message -->
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 dark:text-white mb-4 tracking-tight">
                403
            </h1>
            <p class="text-lg sm:text-xl font-medium text-gray-800 dark:text-gray-200 mb-2">
                Accès refusé
            </p>
            <p class="text-gray-500 dark:text-gray-400 mb-8 leading-relaxed">
                Désolé, vous n'avez pas les autorisations nécessaires pour accéder à cette page. Si vous pensez qu'il s'agit d'une erreur, veuillez contacter l'administrateur.
            </p>

            <!-- Boutons d'action (Style Breeze natif) -->
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('home.after403') }}" 
                   class="inline-flex justify-center items-center px-6 py-3 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-sm text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Retour en arrière
                </a>
                
                <a href="{{ route('dashboard') }}" 
                   class="inline-flex justify-center items-center px-6 py-3 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-sm text-white dark:text-gray-800 hover:bg-gray-700 dark:hover:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    Aller au tableau de bord
                </a>
            </div>

        </div>

    </body>
</html>