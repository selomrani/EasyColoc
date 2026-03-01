<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Rejoindre une colocation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                <h3 class="text-lg text-gray-900 dark:text-gray-100 mb-4">
                    Vous avez été invité à rejoindre : <strong>{{ $invitation->colocation->name }}</strong>
                </h3>

                <form action="{{ route('invitations.join', $invitation->token) }}" method="POST">
                    @csrf
                    <x-primary-button>
                        {{ __('Accepter l\'invitation') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>