<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Users & Colocations</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 font-sans antialiased overflow-hidden flex h-screen">
    <aside class="w-64 bg-slate-900 text-white flex-shrink-0 hidden md:flex flex-col transition-all duration-300">
        <div class="h-16 flex items-center px-6 border-b border-slate-800">
            <i class="fa-solid fa-shield-halved w-6 h-6 text-indigo-400 mr-3 text-xl"></i>
            <span class="text-lg font-bold tracking-wider">ADMIN<span class="text-indigo-400">PANEL</span></span>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="#" class="flex items-center px-4 py-3 bg-indigo-600 text-white rounded-lg transition-colors">
                <i class="fa-solid fa-users w-5 h-5 mr-3"></i>
                Users Management
            </a>
            <a href="#"
                class="flex items-center px-4 py-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg transition-colors">
                <i class="fa-solid fa-house w-5 h-5 mr-3"></i>
                Colocations
            </a>
            <a href="#"
                class="flex items-center px-4 py-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg transition-colors">
                <i class="fa-solid fa-gear w-5 h-5 mr-3"></i>
                Settings
            </a>
        </nav>
        <div class="p-4 border-t border-slate-800">
            <form action="/logout" method="POST">
                @csrf {{-- FIXED: Removed HTML comment wrapper --}}
                <button type="submit"
                    class="flex items-center w-full px-4 py-2 text-slate-300 hover:text-white transition-colors">
                    <i class="fa-solid fa-right-from-bracket w-5 h-5 mr-3"></i>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col overflow-hidden">

        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 lg:px-10 z-10">
            <div class="flex items-center">
                <button class="md:hidden text-slate-500 hover:text-slate-700 focus:outline-none">
                    <i class="fa-solid fa-bars w-6 h-6 text-xl"></i>
                </button>
                <h1 class="text-xl font-semibold text-slate-800 ml-4 md:ml-0">Dashboard Overview</h1>
            </div>
            <div class="flex items-center space-x-4">
                <a href="#" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-regular fa-bell w-5 h-5 text-xl"></i>
                </a>
                <div
                    class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold border border-indigo-200">
                    A
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 p-6 lg:p-10">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center">
                    <div
                        class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center border border-blue-100">
                        <i class="fa-solid fa-users w-6 h-6 text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-sm font-medium text-slate-500">Total Users</h2>
                        <p class="text-2xl font-bold text-slate-800">1,248</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center">
                    <div
                        class="w-12 h-12 rounded-lg bg-emerald-50 flex items-center justify-center border border-emerald-100">
                        <i class="fa-solid fa-house w-6 h-6 text-emerald-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-sm font-medium text-slate-500">Active Colocations</h2>
                        <p class="text-2xl font-bold text-slate-800">432</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center">
                    <div class="w-12 h-12 rounded-lg bg-red-50 flex items-center justify-center border border-red-100">
                        <i class="fa-solid fa-ban w-6 h-6 text-red-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-sm font-medium text-slate-500">Banned Users</h2>
                        <p class="text-2xl font-bold text-slate-800">12</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div
                    class="px-6 py-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <h2 class="text-lg font-semibold text-slate-800">User Management</h2>
                    <form method="GET" action="/users" class="relative">
                        <i
                            class="fa-solid fa-magnifying-glass w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                        <input type="text" name="search" placeholder="Search users..."
                            class="pl-9 pr-4 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none w-full sm:w-64 transition-shadow">
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full whitespace-nowrap text-left text-sm">
                        <thead class="bg-slate-50 text-slate-600 border-b border-slate-200 font-medium">
                            <tr>
                                <th class="px-6 py-4">User</th>
                                <th class="px-6 py-4">Email</th>
                                <th class="px-6 py-4">Joined Date</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 text-slate-700">

                            @foreach ($users as $user)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 flex items-center">
                                        <div
                                            class="w-8 h-8 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center font-bold mr-3">
                                            JD</div>
                                        <span class="font-medium text-slate-900">{{ $user->first_name }}
                                            {{ $user->last_name }}</span>
                                    </td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">{{ $user->created_at }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">{{ $status = $user->is_active ? 'active' : 'banned' }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('users.ban', $user->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-red-700 bg-{{ $color = $user->is_active ? 'red' : 'green' }}-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition ease-in-out duration-150">
                                                <i class="fa-solid fa-ban text-red-600 mr-2"></i>
                                                {{ $status = $user->is_active ? 'ban user' : 'unban user' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-slate-200 flex items-center justify-between bg-slate-50">
                    <span class="text-sm text-slate-500">Showing 1 to 4 of 1,248 results</span>
                    <div class="flex space-x-2">
                        <a href="?page=1"
                            class="px-3 py-1 border border-slate-300 rounded text-sm text-slate-500 bg-white opacity-50 cursor-not-allowed">Previous</a>
                        <a href="?page=2"
                            class="px-3 py-1 border border-slate-300 rounded text-sm text-slate-700 bg-white hover:bg-slate-50">Next</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
