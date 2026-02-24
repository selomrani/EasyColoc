<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>EasyColoc — La colocation simplifiée</title>

        <!-- Fonts: Utilisation de Outfit pour un look plus premium/tech -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
            <style>
                body { font-family: 'Outfit', sans-serif; }
            </div>
        @endif
    </head>
    <body class="antialiased bg-white dark:bg-[#050505] text-slate-900 dark:text-slate-100 selection:bg-indigo-100 selection:text-indigo-900">
        
        <!-- Navigation Raffinée -->
        <nav class="h-24 flex items-center relative z-50">
            <div class="max-w-7xl mx-auto px-6 w-full flex justify-between items-center">
                <!-- Logo Custom "Fintech" -->
                <div class="flex items-center gap-3 group cursor-default">
                    <div class="relative w-10 h-10 flex items-center justify-center">
                        <div class="absolute inset-0 bg-indigo-600 rounded-xl rotate-6 group-hover:rotate-12 transition-transform duration-300"></div>
                        <div class="absolute inset-0 bg-slate-900 dark:bg-white rounded-xl -rotate-6 group-hover:-rotate-12 transition-transform duration-300"></div>
                        <svg class="relative w-5 h-5 text-white dark:text-slate-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path d="M12 6v12m-3-3l3 3 3-3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span class="font-extrabold text-2xl tracking-tighter bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-slate-500 dark:from-white dark:to-slate-400">
                        EasyColoc
                    </span>
                </div>

                @if (Route::has('login'))
                    <div class="flex items-center gap-10">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-bold tracking-tight hover:text-indigo-600 transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-bold tracking-tight hover:text-indigo-600 transition-colors">Connexion</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="group relative px-6 py-2.5 bg-indigo-600 text-white text-sm font-bold rounded-full overflow-hidden transition-all shadow-lg shadow-indigo-600/20">
                                    <span class="relative z-10">Ouvrir un compte</span>
                                    <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </nav>

        <!-- Hero Section Asymétrique -->
        <header class="relative pt-12 pb-32 overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 flex flex-col lg:flex-row items-center gap-20">
                
                <!-- Texte -->
                <div class="flex-1 text-left relative z-10">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-slate-200 dark:border-slate-800 text-xs font-bold mb-10 tracking-wide uppercase">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Disponible sur Web & Mobile
                    </div>
                    <h1 class="text-6xl lg:text-[84px] font-[800] tracking-[-0.05em] leading-[0.9] mb-8">
                        L'argent ne doit pas être <span class="text-indigo-600">un sujet.</span>
                    </h1>
                    <p class="text-xl text-slate-500 dark:text-slate-400 mb-12 max-w-lg leading-relaxed font-medium">
                        La plateforme de gestion de colocation qui automatise vos calculs et simplifie vos remboursements.
                    </p>
                    <div class="flex items-center gap-5">
                        @guest
                            <a href="{{ route('register') }}" class="px-8 py-4 bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-extrabold rounded-2xl transition-all hover:-translate-y-1 shadow-2xl">
                                Démarrer gratuitement
                            </a>
                        @else
                            <a href="{{ url('/dashboard') }}" class="px-8 py-4 bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-extrabold rounded-2xl transition-all hover:-translate-y-1 shadow-2xl">
                                Accéder au dashboard
                            </a>
                        @endguest
                    </div>
                </div>

                <!-- Illustration Tech / Glassmorphism -->
                <div class="flex-1 relative w-full">
                    <div class="relative w-full aspect-[4/3] rounded-[3rem] bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 p-8 flex items-center justify-center">
                        <!-- Abstract Flow Illustration -->
                        <svg class="w-full h-full text-indigo-600/10 dark:text-indigo-400/5" viewBox="0 0 400 300" fill="none">
                            <path d="M50 150Q125 50 200 150T350 150" stroke="currentColor" stroke-width="60" stroke-linecap="round"/>
                        </svg>

                        <!-- Floating UI Elements -->
                        <div class="absolute top-12 left-12 p-6 bg-white dark:bg-slate-950 border border-slate-100 dark:border-slate-800 rounded-3xl shadow-2xl w-48 animate-bounce" style="animation-duration: 4s;">
                            <div class="w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center mb-3">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 4v16m8-8H4" stroke-linecap="round"/></svg>
                            </div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Dépense</p>
                            <p class="text-xl font-black italic">142.00€</p>
                        </div>

                        <div class="absolute bottom-16 right-12 p-6 bg-slate-900 text-white rounded-3xl shadow-2xl w-56 transform translate-y-4">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-[10px] font-bold tracking-widest opacity-50 uppercase text-white">Balances</span>
                                <div class="w-2 h-2 rounded-full bg-emerald-400"></div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-xs font-medium">Marc → Alex</span>
                                    <span class="text-xs font-black">12.50€</span>
                                </div>
                                <div class="h-px bg-white/10 w-full"></div>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs font-medium">Julie → Alex</span>
                                    <span class="text-xs font-black">28.00€</span>
                                </div>
                            </div>
                        </div>

                        <!-- Central Connection -->
                        <div class="w-24 h-24 bg-white dark:bg-slate-950 rounded-full border-4 border-indigo-600 flex items-center justify-center shadow-2xl z-20">
                            <svg class="w-10 h-10 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Stats / Proof -->
        <section class="py-20 bg-slate-50 dark:bg-slate-900/20">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-12 text-center">
                    <div>
                        <p class="text-4xl font-black mb-1">98%</p>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Satisfaction</p>
                    </div>
                    <div>
                        <p class="text-4xl font-black mb-1">+2k</p>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Colocations</p>
                    </div>
                    <div>
                        <p class="text-4xl font-black mb-1">0€</p>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Calculs manuels</p>
                    </div>
                    <div>
                        <p class="text-4xl font-black mb-1">100%</p>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Transparent</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer Raffiné -->
        <footer class="py-20 border-t border-slate-100 dark:border-slate-900">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-12 mb-20">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-slate-900 dark:bg-white rounded-lg flex items-center justify-center text-white dark:text-slate-900">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path d="M12 6v12m-3-3l3 3 3-3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <span class="font-black text-xl tracking-tighter uppercase">EasyColoc</span>
                        </div>
                        <p class="text-sm text-slate-500 max-w-xs font-medium">
                            Conçu pour éliminer les tensions financières au sein des habitats partagés.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-16">
                        <div class="space-y-4">
                            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Produit</p>
                            <ul class="text-sm font-bold space-y-2">
                                <li><a href="#" class="hover:text-indigo-600">Fonctionnalités</a></li>
                                <li><a href="#" class="hover:text-indigo-600">Sécurité</a></li>
                            </ul>
                        </div>
                        <div class="space-y-4">
                            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Stack</p>
                            <ul class="text-sm font-bold space-y-2">
                                <li><a href="#" class="hover:text-indigo-600 text-slate-400">Laravel v11</a></li>
                                <li><a href="#" class="hover:text-indigo-600 text-slate-400">Tailwind CSS</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="pt-10 border-t border-slate-50 dark:border-slate-900 flex flex-col md:flex-row justify-between items-center gap-6">
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                        &copy; {{ date('Y') }} EasyColoc. Tous droits réservés.
                    </p>
                    <div class="flex gap-6">
                        <div class="h-8 w-8 rounded-full bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-800 flex items-center justify-center text-slate-400 hover:text-indigo-600 cursor-pointer transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.463-1.11-1.463-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12c0-5.523-4.477-10-10-10z"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </body>
</html>