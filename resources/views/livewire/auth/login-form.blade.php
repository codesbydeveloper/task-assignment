<div class="min-h-[70vh] flex items-center justify-center py-12">
    <div class="w-full max-w-md">
        <div class="card p-8 sm:p-10">
            <div class="text-center mb-8">
                <div class="w-14 h-14 rounded-2xl bg-primary-100 flex items-center justify-center text-primary-600 mx-auto mb-4">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                </div>
                <h1 class="text-2xl font-bold text-slate-800">Welcome back</h1>
                <p class="mt-2 text-slate-500 text-sm">Sign in to your account to continue</p>
            </div>

            <form wire:submit.prevent="submit" class="space-y-6">
                <div>
                    <label for="login-email" class="block text-sm font-semibold text-slate-700 mb-2">Email address</label>
                    <input id="login-email" type="email" wire:model.defer="email" autocomplete="email" placeholder="you@example.com"
                           class="block w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-800 placeholder-slate-400 text-sm shadow-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition" />
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div x-data="{ showPass: false }">
                    <label for="login-password" class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                    <div class="relative">
                        <input id="login-password" :type="showPass ? 'text' : 'password'" wire:model.defer="password" autocomplete="current-password" placeholder="••••••••"
                               class="block w-full rounded-xl border border-slate-300 px-4 py-3 pr-11 text-slate-800 placeholder-slate-400 text-sm shadow-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition" />
                        <button type="button" @click="showPass = !showPass" class="absolute right-3 top-1/2 -translate-y-1/2 p-1 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition" aria-label="Toggle password visibility">
                            <svg x-show="!showPass" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg x-show="showPass" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878a4.5 4.5 0 106.262 6.262M4.031 11.117A10.047 10.047 0 003 12c0 4.478 2.943 8.268 7 9.542 2.125-1.02 4.165-1.564 6.182-1.775a3 3 0 003.686-3.686 10.047 10.047 0 00-2.102-5.759z"/></svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" wire:model="remember" class="h-4 w-4 rounded border-slate-300 text-primary-600 focus:ring-2 focus:ring-primary-500/20" />
                        <span class="text-sm font-medium text-slate-600">Remember me</span>
                    </label>
                </div>

                <button type="submit" class="w-full rounded-xl px-4 py-3 text-base font-semibold text-white bg-primary-600 hover:bg-primary-700 focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 shadow-sm hover:shadow transition inline-flex items-center justify-center gap-2 disabled:opacity-70" wire:loading.attr="disabled">
                    <span wire:loading.remove>Sign in</span>
                    <span wire:loading class="inline-flex items-center gap-2">
                        <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        Signing in...
                    </span>
                </button>
            </form>

            <p class="mt-8 text-center text-sm text-slate-500">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-semibold text-primary-600 hover:text-primary-700 transition">Create account</a>
            </p>
        </div>
    </div>
</div>
