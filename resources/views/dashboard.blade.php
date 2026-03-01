<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tableau de bord') }}
            </h2>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600 dark:text-gray-400">
                    Réputation :
                    <span
                        class="font-bold {{ auth()->user()->reputation_score >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                        {{ auth()->user()->reputation_score > 0 ? '+' : '' }}{{ auth()->user()->reputation_score ?? 0 }}
                    </span>
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ open: false, editOpen: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">

            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @endif

            @if (!auth()->user()->hasActiveColocation())
                <div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h4 class="text-lg font-bold mb-2">Créer une colocation</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">Vous n'êtes membre d'aucune
                                    colocation actuellement. Créez la vôtre pour commencer.</p>

                                <form action="{{ route('colocations.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="name"
                                            class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nom de la
                                            colocation</label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                            required>

                                        @error('name')
                                            <span
                                                class="text-sm text-red-600 dark:text-red-400 mt-2 block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="flex items-center justify-end mt-4">
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                            Créer
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h4 class="text-lg font-bold mb-4">Invitations reçues</h4>
                                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <li class="py-3 flex justify-between items-center">
                                        <div>
                                            <p class="font-medium">Appartement Centre-Ville</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Invitée par Jean Dupont
                                            </p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <form action="#" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    Accepter
                                                </button>
                                            </form>
                                            <form action="#" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                                    Refuser
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="mt-12">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 flex flex-col md:flex-row justify-between items-start md:items-center">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $colocation->name }}
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    Votre rôle : <span class="font-semibold text-indigo-600 dark:text-indigo-400">
                                        @if ($colocation->isOwner(Auth::id()))
                                            Owner
                                        @else
                                            Membre
                                        @endif
                                    </span>
                                </p>
                            </div>
                            @if ($colocation->isOwner(Auth::id()))
                                <div class="mt-4 md:mt-0 flex space-x-3">
                                    <button @click="editOpen = true" type="button"
                                        class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-200 dark:hover:bg-gray-600 transition ease-in-out duration-150">
                                        Modifier infos
                                    </button>
                                    <button @click="open = true" type="button"
                                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Inviter un membre
                                    </button>
                                    <form action="{{ route('colocations.cancel', $colocation) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette colocation ?')"
                                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                            Annuler la colocation
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                        {{-- Colonne Principale (Dépenses) --}}
                        <div class="lg:col-span-2 space-y-6">

                            {{-- Section Dépenses --}}
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div
                                    class="p-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                                    <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">Dépenses communes
                                    </h4>
                                    <a href="#"
                                        class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                        Ajouter
                                    </a>
                                </div>

                                <div class="p-6">
                                    {{-- Filtre par mois --}}
                                    <form method="GET" action="#" class="mb-6 flex items-end space-x-4">
                                        <div>
                                            <label for="month"
                                                class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Filtrer
                                                par mois</label>
                                            <input type="month" name="month" id="month"
                                                value="{{ request('month', now()->format('Y-m')) }}"
                                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm sm:text-sm">
                                        </div>
                                        <button type="button"
                                            class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition ease-in-out duration-150">
                                            Filtrer
                                        </button>
                                        <a href="#"
                                            class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">Voir
                                            tout</a>
                                    </form>

                                    {{-- Liste des dépenses --}}
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                            <thead class="bg-gray-50 dark:bg-gray-900/50">
                                                <tr>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                        Date</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                        Titre</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                        Catégorie</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                        Payé par</th>
                                                    <th
                                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                        Montant</th>
                                                </tr>
                                            </thead>
                                            <tbody
                                                class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                                <tr>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                        25/10/2023</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                                        Courses Carrefour</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                        Alimentation</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                        Jean Dupont</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium text-gray-900 dark:text-gray-100">
                                                        120.50 €</td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                        01/10/2023</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                                        Facture Internet</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                        Factures</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                        Marie Martin</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium text-gray-900 dark:text-gray-100">
                                                        29.99 €</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Colonne Latérale (Membres & Dettes) --}}
                        <div class="space-y-6">

                            {{-- Section : Qui doit quoi à qui --}}
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6">
                                    <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Remboursements
                                    </h4>
                                    <ul class="space-y-4">
                                        <li
                                            class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-lg border border-gray-200 dark:border-gray-700">
                                            <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                                <span class="font-medium text-gray-900 dark:text-gray-100">Marie</span>
                                                doit à <span
                                                    class="font-medium text-gray-900 dark:text-gray-100">Jean</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-lg font-bold text-gray-900 dark:text-gray-100">45.25
                                                    €</span>
                                                <form action="#" method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 font-medium">
                                                        Marquer payé
                                                    </button>
                                                </form>
                                            </div>
                                        </li>
                                        <li
                                            class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-lg border border-gray-200 dark:border-gray-700">
                                            <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                                <span class="font-medium text-gray-900 dark:text-gray-100">Lucas</span>
                                                doit à <span
                                                    class="font-medium text-gray-900 dark:text-gray-100">Marie</span>
                                            </div>
                                            <div>
                                                <span class="text-lg font-bold text-gray-900 dark:text-gray-100">15.00
                                                    €</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            {{-- Section Membres --}}
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6">
                                    <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Membres (3)
                                    </h4>
                                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                        <li class="py-3 flex justify-between items-center">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    Jean Dupont <span
                                                        class="text-xs text-indigo-600 dark:text-indigo-400 ml-1">(Owner)</span>
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Rép: +5</p>
                                            </div>
                                        </li>
                                        <li class="py-3 flex justify-between items-center">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Marie
                                                    Martin</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Rép: +2</p>
                                            </div>
                                            <form action="#" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-sm text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 font-medium">
                                                    Retirer
                                                </button>
                                            </form>
                                        </li>
                                        <li class="py-3 flex justify-between items-center">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Lucas
                                                    Bernard</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Rép: -1</p>
                                            </div>
                                            <form action="#" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-sm text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 font-medium">
                                                    Retirer
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif

        </div>

        {{-- Modale Inviter --}}
        @if(isset($colocation) && $colocation)
        <div x-show="open" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black opacity-50" @click="open = false"></div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 z-10 w-full max-w-md">
                <h3 class="text-lg font-bold mb-4 dark:text-white">Inviter un colocataire</h3>
                <form action="{{ route('colocation.invite', $colocation->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium dark:text-gray-300 text-gray-700">
                            Email du futur membre
                        </label>
                        <input type="email" name="email" required
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" @click="open = false"
                            class="text-gray-500 hover:text-gray-700 transition">Annuler</button>
                        <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition shadow-sm">
                            Envoyer l'invitation
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modale Modifier --}}
        <div x-show="editOpen" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black opacity-50" @click="editOpen = false"></div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 z-10 w-full max-w-md">
                <h3 class="text-lg font-bold mb-4 dark:text-white">Modifier la colocation</h3>
                <form action="{{ route('colocation.update', $colocation) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium dark:text-gray-300">Nom de la colocation</label>
                        <input type="text" name="name" value="{{ $colocation->name ?? '' }}" required
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" @click="editOpen = false"
                            class="text-gray-500 hover:underline">Annuler</button>
                        <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</x-app-layout>
