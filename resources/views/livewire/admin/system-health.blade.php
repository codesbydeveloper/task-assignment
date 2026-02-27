<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">System health</h1>
        </div>
        <button wire:click="refreshHealth" class="btn-primary inline-flex items-center gap-2" wire:loading.attr="disabled">
            <span wire:loading.remove>Refresh</span>
            <span wire:loading class="inline-flex items-center gap-2">
                <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                Refreshing
            </span>
        </button>
    </div>

    <div class="card overflow-hidden p-0">
        @if(!empty($health))
            <div class="p-6 space-y-5">
                <div class="flex items-center gap-3">
                    <span class="text-sm font-semibold text-slate-600">Overall status:</span>
                    <span class="inline-flex px-3 py-1 rounded-full text-sm font-medium {{ ($health['status'] ?? '') === 'ok' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                        {{ $health['status'] ?? 'unknown' }}
                    </span>
                </div>
                @if(!empty($health['checks']))
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                        @foreach($health['checks'] as $key => $value)
                            <div class="flex justify-between items-center py-3 px-4 rounded-xl bg-slate-50 border border-slate-100">
                                <dt class="text-slate-600 font-medium">{{ ucfirst(str_replace('_', ' ', $key)) }}</dt>
                                <dd class="font-mono text-sm {{ $value === 'ok' ? 'text-emerald-600 font-semibold' : ($value === 'failed' || $value === 'error' ? 'text-red-600 font-semibold' : 'text-slate-800') }}">
                                    {{ is_scalar($value) ? $value : json_encode($value) }}
                                </dd>
                            </div>
                        @endforeach
                    </dl>
                @endif
            </div>
        @else
            <div class="p-12 text-center">
                <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <p class="text-slate-500 font-medium">No health data.</p>
                <p class="text-sm text-slate-400 mt-1">Click Refresh to load system status.</p>
            </div>
        @endif
    </div>
</div>
