<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Queue status</h1>
        <p class="mt-1 text-slate-500">Pending and failed job counts.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div class="card p-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-xl bg-primary-100 text-primary-600 flex items-center justify-center">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Pending jobs</p>
                    <p class="mt-1 text-3xl font-bold text-slate-800">{{ $jobs }}</p>
                </div>
            </div>
        </div>
        <div class="card p-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-xl {{ $failed > 0 ? 'bg-red-100 text-red-600' : 'bg-slate-100 text-slate-600' }} flex items-center justify-center">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Failed jobs</p>
                    <p class="mt-1 text-3xl font-bold {{ $failed > 0 ? 'text-red-600' : 'text-slate-800' }}">{{ $failed }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
