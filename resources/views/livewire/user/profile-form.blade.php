<div class="max-w-2xl">
    @if (session('password_changed'))
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50" x-data="{ open: true }" x-show="open" x-cloak>
            <div class="bg-white rounded-2xl shadow-xl max-w-sm w-full p-6 text-center" @click.outside="open = false">
                <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-emerald-100 mb-4">
                    <svg class="h-7 w-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-800">Password changed</h3>
                <p class="mt-2 text-sm text-slate-600">Your password has been updated successfully. Use it for your next login.</p>
                <button type="button" @click="open = false" class="mt-6 w-full btn-primary py-2.5">OK</button>
            </div>
        </div>
    @endif

    <div class="card overflow-hidden">
        <div class="px-6 py-6 border-b border-slate-200 bg-slate-50/50">
            <h1 class="text-xl font-bold text-slate-800">Profile</h1>
            <p class="mt-1 text-sm text-slate-500">Update your name, email, and password.</p>
        </div>
        <div class="px-6 py-6">
            <form wire:submit.prevent="update" class="space-y-5">
                <div>
                    <label for="profile-name" class="block text-sm font-semibold text-slate-700 mb-2">Name</label>
                    <input id="profile-name" type="text" wire:model.defer="name" class="input-field" />
                    @error('name')
                        <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="profile-email" class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                    <input id="profile-email" type="email" wire:model.defer="email" class="input-field" />
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div x-data="{ showPass: false }">
                        <label for="profile-password" class="block text-sm font-semibold text-slate-700 mb-2">New password</label>
                        <div class="relative">
                            <input id="profile-password" :type="showPass ? 'text' : 'password'" wire:model.defer="password" class="input-field pr-11" placeholder="Leave blank to keep current" />
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
                        <label for="profile-password-confirm" class="block text-sm font-semibold text-slate-700 mb-2">Confirm password</label>
                        <div class="relative">
                            <input id="profile-password-confirm" :type="showPass ? 'text' : 'password'" wire:model.defer="password_confirmation" class="input-field pr-11" placeholder="••••••••" />
                            <button type="button" @click="showPass = !showPass" class="absolute right-3 top-1/2 -translate-y-1/2 p-1 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition" aria-label="Toggle password visibility">
                                <svg x-show="!showPass" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="showPass" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878a4.5 4.5 0 106.262 6.262M4.031 11.117A10.047 10.047 0 003 12c0 4.478 2.943 8.268 7 9.542 2.125-1.02 4.165-1.564 6.182-1.775a3 3 0 003.686-3.686 10.047 10.047 0 00-2.102-5.759z"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="btn-primary inline-flex items-center gap-2" wire:loading.attr="disabled">
                        <span wire:loading.remove>Save changes</span>
                        <span wire:loading class="inline-flex items-center gap-2">
                            Saving...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
