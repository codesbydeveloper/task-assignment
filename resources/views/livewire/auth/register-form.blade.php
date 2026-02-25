<div class="min-h-[70vh] flex items-center justify-center py-12">
    <div class="w-full max-w-md">
        <div class="card p-8 sm:p-10">
            <div class="text-center mb-8">
                <div class="w-14 h-14 rounded-2xl bg-primary-100 flex items-center justify-center text-primary-600 mx-auto mb-4">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                </div>
                <h1 class="text-2xl font-bold text-slate-800">Create your account</h1>
                <p class="mt-2 text-slate-500 text-sm">Get started with your free account</p>
            </div>

            <form wire:submit.prevent="submit" class="space-y-6">
                <div>
                    <label for="reg-name" class="block text-sm font-semibold text-slate-700 mb-2">Full name</label>
                    <input id="reg-name" type="text" wire:model.defer="name" autocomplete="name" placeholder="John Doe"
                           class="input-field" />
                    @error('name')
                        <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="reg-email" class="block text-sm font-semibold text-slate-700 mb-2">Email address</label>
                    <input id="reg-email" type="email" wire:model.defer="email" autocomplete="email" placeholder="you@example.com"
                           class="input-field" />
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div x-data="{ showPass: false }">
                    <label for="reg-password" class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                    <div class="relative">
                        <input id="reg-password" :type="showPass ? 'text' : 'password'" wire:model.defer="password" autocomplete="new-password" placeholder="Min. 8 characters"
                               class="input-field pr-11" />
                        <button type="button" @click="showPass = !showPass" class="absolute right-3 top-1/2 -translate-y-1/2 p-1 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition" aria-label="Toggle password visibility">
                            <svg x-show="!showPass" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg x-show="showPass" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878a4.5 4.5 0 106.262 6.262M4.031 11.117A10.047 10.047 0 003 12c0 4.478 2.943 8.268 7 9.542 2.125-1.02 4.165-1.564 6.182-1.775a3 3 0 003.686-3.686 10.047 10.047 0 00-2.102-5.759z"/></svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div x-data="{ showPass: false }">
                    <label for="reg-password-confirm" class="block text-sm font-semibold text-slate-700 mb-2">Confirm password</label>
                    <div class="relative">
                        <input id="reg-password-confirm" :type="showPass ? 'text' : 'password'" wire:model.defer="password_confirmation" autocomplete="new-password" placeholder="••••••••"
                               class="input-field pr-11" />
                        <button type="button" @click="showPass = !showPass" class="absolute right-3 top-1/2 -translate-y-1/2 p-1 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition" aria-label="Toggle password visibility">
                            <svg x-show="!showPass" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg x-show="showPass" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878a4.5 4.5 0 106.262 6.262M4.031 11.117A10.047 10.047 0 003 12c0 4.478 2.943 8.268 7 9.542 2.125-1.02 4.165-1.564 6.182-1.775a3 3 0 003.686-3.686 10.047 10.047 0 00-2.102-5.759z"/></svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full btn-primary py-3 text-base" wire:loading.attr="disabled">
                    <span wire:loading.remove>Create account</span>
                    <span wire:loading class="inline-flex items-center gap-2">
                        <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        Creating account...
                    </span>
                </button>
            </form>

            <p class="mt-8 text-center text-sm text-slate-500">
                Already have an account?
                <a href="{{ route('login') }}" class="font-semibold text-primary-600 hover:text-primary-700 transition">Sign in</a>
            </p>
        </div>
    </div>
</div>
