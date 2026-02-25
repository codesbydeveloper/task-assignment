<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Activity log</h1>
        <p class="mt-1 text-slate-500">Your recent actions and events.</p>
    </div>

    <div class="card overflow-hidden p-0">
        <div class="divide-y divide-slate-200">
            @forelse ($logs as $log)
                <div class="p-5 hover:bg-slate-50/50 transition flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-primary-100 text-primary-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold text-slate-800">{{ $log->action }}</p>
                        <p class="mt-1 text-xs text-slate-500">
                            {{ $log->created_at->toDayDateTimeString() }} · IP: {{ $log->ip_address ?? '—' }}
                        </p>
                        <p class="mt-0.5 text-xs text-slate-400 truncate" title="{{ $log->user_agent }}">{{ \Illuminate\Support\Str::limit($log->user_agent, 60) }}</p>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center">
                    <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <p class="text-slate-500 font-medium">No activity recorded yet.</p>
                    <p class="text-sm text-slate-400 mt-1">Your actions will appear here.</p>
                </div>
            @endforelse
        </div>
        @if($logs->hasPages())
            <div class="px-5 py-4 border-t border-slate-200 bg-slate-50/50">
                {{ $logs->links() }}
            </div>
        @endif
    </div>
</div>
