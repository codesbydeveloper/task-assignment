<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Cron job logs</h1>
        <p class="mt-1 text-slate-500">Execution history for scheduled commands.</p>
    </div>

    <div class="card overflow-hidden p-0">
        <div class="divide-y divide-slate-200">
            @forelse ($logs as $log)
                <div class="p-5 hover:bg-slate-50/50 transition flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl {{ $log->status === 'success' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600' }} flex items-center justify-center flex-shrink-0">
                        @if($log->status === 'success')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        @endif
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <code class="text-sm bg-slate-100 px-2.5 py-1 rounded-lg text-slate-700 font-mono">{{ $log->command }}</code>
                            <span class="text-xs text-slate-500">{{ $log->created_at->toDayDateTimeString() }}</span>
                        </div>
                        <div class="mt-2 flex flex-wrap items-center gap-2">
                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium {{ $log->status === 'success' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($log->status) }}
                            </span>
                            @if($log->finished_at)
                                <span class="text-xs text-slate-500">Duration: {{ $log->started_at->diffInSeconds($log->finished_at) }}s</span>
                            @endif
                        </div>
                        @if($log->message)
                            <p class="mt-2 text-sm text-slate-600">{{ $log->message }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="p-12 text-center">
                    <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <p class="text-slate-500 font-medium">No cron logs yet.</p>
                    <p class="text-sm text-slate-400 mt-1">Logs will appear here after scheduled tasks run.</p>
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
