<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Notifications</h1>
        <p class="mt-1 text-slate-500">Your notification history with pagination.</p>
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
                    <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    </div>
                    <p class="text-slate-500 font-medium">No notifications yet.</p>
                    <p class="text-sm text-slate-400 mt-1">You'll see your notifications here when they arrive.</p>
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
