{{-- Professional UI – Blade + Livewire. Interview-ready. --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} – @yield('title', 'Dashboard')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Plus Jakarta Sans', 'system-ui', 'sans-serif'] },
                    colors: {
                        primary: { 50: '#eef2ff', 100: '#e0e7ff', 200: '#c7d2fe', 300: '#a5b4fc', 400: '#818cf8', 500: '#6366f1', 600: '#4f46e5', 700: '#4338ca', 800: '#3730a3', 900: '#312e81' },
                        surface: { 50: '#f8fafc', 100: '#f1f5f9', 200: '#e2e8f0' }
                    },
                    boxShadow: {
                        'soft': '0 2px 15px -3px rgba(0,0,0,0.07), 0 10px 20px -2px rgba(0,0,0,0.04)',
                        'card': '0 1px 3px 0 rgba(0,0,0,0.06), 0 1px 2px -1px rgba(0,0,0,0.06)',
                        'card-hover': '0 10px 40px -10px rgba(0,0,0,0.12)'
                    }
                }
            }
        };
    </script>
    <style>
        [x-cloak]{display:none!important}
        /* Explicit styles so .btn-primary and .input-field work with Tailwind CDN (no @apply) */
        .btn-primary {
            display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem;
            padding: 0.625rem 1rem; border-radius: 0.75rem; font-size: 0.875rem; font-weight: 600;
            color: #fff; background: #4f46e5; border: none; cursor: pointer;
            box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05); transition: all 0.15s ease;
        }
        .btn-primary:hover { background: #4338ca; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .btn-primary:focus { outline: none; box-shadow: 0 0 0 2px #fff, 0 0 0 4px #6366f1; }
        .input-field {
            display: block; width: 100%; padding: 0.5rem 1rem; border-radius: 0.75rem;
            border: 1px solid #cbd5e1; font-size: 0.875rem; color: #1e293b;
            box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05); transition: border-color 0.15s, box-shadow 0.15s;
        }
        .input-field::placeholder { color: #94a3b8; }
        .input-field:focus { outline: none; border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,0.2); }
        .card {
            background: #fff; border-radius: 1rem; border: 1px solid rgba(226,232,240,0.8);
            box-shadow: 0 1px 3px 0 rgba(0,0,0,0.06); overflow: hidden;
        }
    </style>
    @livewireStyles
</head>
<body class="bg-surface-100 min-h-screen antialiased font-sans text-slate-700">
    <div class="min-h-screen flex flex-col">
        {{-- Premium Navbar --}}
        <nav class="bg-white/95 backdrop-blur border-b border-slate-200/80 shadow-soft" x-data="{ mobileOpen: false }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center gap-8">
                        @auth
                            <div class="hidden md:flex items-center gap-1">
                                <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">Dashboard</a>
                                <a href="{{ route('profile') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition {{ request()->routeIs('profile') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">Profile</a>
                                <a href="{{ route('notifications') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition {{ request()->routeIs('notifications') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">Notifications</a>
                                <a href="{{ route('activity') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition {{ request()->routeIs('activity') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">Activity</a>
                                @if(auth()->user()?->isAdmin())
                                    <span class="w-px h-5 bg-slate-200 mx-1"></span>
                                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.*') ? 'bg-amber-50 text-amber-800' : 'text-slate-600 hover:bg-amber-50 hover:text-amber-800' }}">Admin</a>
                                    <a href="{{ route('admin.users') }}" class="px-4 py-2 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">Users</a>
                                    <a href="{{ route('admin.cron_logs') }}" class="px-4 py-2 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">Cron</a>
                                    <a href="{{ route('admin.queue') }}" class="px-4 py-2 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">Queue</a>
                                    <a href="{{ route('admin.health') }}" class="px-4 py-2 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">Health</a>
                                @endif
                            </div>
                            <button type="button" class="md:hidden p-2.5 rounded-xl text-slate-500 hover:bg-slate-100 hover:text-slate-700 transition" @click="mobileOpen = !mobileOpen" aria-label="Menu">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                            </button>
                        @endauth
                    </div>
                    <div class="flex items-center gap-4">
                        @auth
                            <div class="hidden sm:flex items-center gap-3">
                                <span class="text-sm font-medium text-slate-600">{{ auth()->user()->name }}</span>
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-semibold {{ auth()->user()->isAdmin() ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-600' }}">{{ ucfirst(auth()->user()->role) }}</span>
                            </div>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-sm font-medium text-slate-500 hover:text-red-600 transition">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900 transition">Sign in</a>
                            <a href="{{ route('register') }}" class="btn-primary">Get started</a>
                        @endauth
                    </div>
                </div>
                @auth
                    <div class="md:hidden border-t border-slate-100 py-4 space-y-1" x-show="mobileOpen" x-cloak>
                        <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50">Dashboard</a>
                        <a href="{{ route('profile') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50">Profile</a>
                        <a href="{{ route('notifications') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50">Notifications</a>
                        <a href="{{ route('activity') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50">Activity</a>
                        @if(auth()->user()?->isAdmin())
                            <div class="pt-3 mt-3 border-t border-slate-200">
                                <p class="px-4 py-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">Admin</p>
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-amber-800 hover:bg-amber-50">Dashboard</a>
                                <a href="{{ route('admin.users') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50">Users</a>
                                <a href="{{ route('admin.cron_logs') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50">Cron logs</a>
                                <a href="{{ route('admin.queue') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50">Queue</a>
                                <a href="{{ route('admin.health') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50">Health</a>
                            </div>
                        @endif
                    </div>
                @endauth
            </div>
        </nav>

        {{-- Flash messages --}}
        <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-5">
            @if (session('status'))
                <div class="rounded-2xl p-4 mb-4 bg-emerald-50 border border-emerald-200/80 text-emerald-800 text-sm font-medium flex items-center justify-between gap-4 shadow-card" role="alert">
                    <span class="flex items-center gap-3"><span class="w-8 h-8 rounded-full bg-emerald-200 flex items-center justify-center text-emerald-700">✓</span>{{ session('status') }}</span>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800 p-1 rounded-lg hover:bg-emerald-100 transition">×</button>
                </div>
            @endif
            @if (session('error'))
                <div class="rounded-2xl p-4 mb-4 bg-red-50 border border-red-200/80 text-red-800 text-sm font-medium flex items-center justify-between gap-4 shadow-card" role="alert">
                    <span class="flex items-center gap-3"><span class="w-8 h-8 rounded-full bg-red-200 flex items-center justify-center text-red-700">!</span>{{ session('error') }}</span>
                    <button type="button" onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-800 p-1 rounded-lg hover:bg-red-100 transition">×</button>
                </div>
            @endif
        </div>

        <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pb-12">
            {{ $slot ?? '' }}
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="mt-auto border-t border-slate-200/80 bg-white/50 py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-slate-500">
                <span>Made By Abhinav</span>
                <span>Built with Laravel 11, Livewire & Tailwind</span>
            </div>
        </footer>
    </div>

    {{-- Loading toast --}}
    <div wire:loading.delay.long class="fixed bottom-6 right-6 rounded-2xl bg-slate-800 text-white px-5 py-3 text-sm font-medium shadow-card-hover flex items-center gap-3" style="z-index: 9999;">
        <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
        Loading...
    </div>

    @livewireScripts
</body>
</html>
