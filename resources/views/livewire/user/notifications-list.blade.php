<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Notifications</h1>
    </div>

    <div class="card overflow-hidden p-0">
        <div class="divide-y divide-slate-200">
            @forelse ($notifications as $notification)
                <div class="p-5 hover:bg-slate-50/50 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                        <span class="text-sm font-semibold text-slate-700">{{ ucfirst($notification->type ?? 'Notification') }}</span>
                        <span class="text-xs text-slate-500">{{ $notification->created_at->diffForHumans() }}</span>
                    </div>
                    <pre class="text-xs bg-slate-50 p-3 rounded-xl overflow-x-auto border border-slate-100 font-mono">{{ json_encode($notification->data, JSON_PRETTY_PRINT) }}</pre>
                    <span class="mt-3 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                        @if($notification->status === 'pending') bg-amber-100 text-amber-800
                        @elseif($notification->status === 'sent') bg-emerald-100 text-emerald-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ ucfirst($notification->status) }}
                    </span>
                </div>
            @empty
                <div class="p-12 text-center">
                    <p class="text-slate-500 font-medium">No notifications yet.</p>
                </div>
            @endforelse
        </div>
        @if($notifications->hasPages())
            <div class="px-5 py-4 border-t border-slate-200 bg-slate-50/50">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>
</div>
