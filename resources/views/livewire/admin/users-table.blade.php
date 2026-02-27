<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">User management</h1>
    </div>

    <div class="card overflow-hidden p-0">
        <div class="p-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center gap-3 bg-slate-50/50">
            <input type="text" wire:model.live.debounce.500ms="search"
                   placeholder="Search by name or email"
                   class="input-field w-full sm:w-72" />
            <select wire:model.live="role"
                    class="input-field w-full sm:w-44">
                <option value="">All roles</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-5 py-3.5 text-left font-semibold text-slate-700">Name</th>
                        <th class="px-5 py-3.5 text-left font-semibold text-slate-700">Email</th>
                        <th class="px-5 py-3.5 text-left font-semibold text-slate-700">Role</th>
                        <th class="px-5 py-3.5 text-left font-semibold text-slate-700">Status</th>
                        <th class="px-5 py-3.5 text-left font-semibold text-slate-700">Created</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse ($users as $user)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-5 py-4 font-medium text-slate-800">{{ $user->name }}</td>
                            <td class="px-5 py-4 text-slate-600">{{ $user->email }}</td>
                            <td class="px-5 py-4">
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium {{ $user->role === 'admin' ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-700' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium {{ $user->active ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $user->active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-slate-500">{{ $user->created_at->toDateString() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-12 text-center">
                                <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                </div>
                                <p class="text-slate-500 font-medium">No users found.</p>
                                <p class="text-sm text-slate-400 mt-1">Try adjusting your search or filters.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="px-5 py-4 border-t border-slate-200 bg-slate-50/50">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
