<div class="space-y-8">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Dashboard</h1>
        <p class="mt-1 text-slate-500">Overview of your account and activity.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <a href="{{ route('profile') }}" class="card p-6 group hover:border-primary-200 hover:shadow-md transition-all duration-200">
            <div class="flex items-center gap-4">
                
                <div>
                    <p class="text-sm font-medium text-slate-500">Profile</p>
                    <p class="text-lg font-semibold text-slate-800">Manage</p>
                </div>
            </div>
        </a>
        <div class="card p-6">
            <div class="flex items-center gap-4">
              
                <div>
                    <p class="text-sm font-medium text-slate-500">Your transactions</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $totalTransactions }}</p>
                </div>
            </div>
        </div>
        <a href="{{ route('notifications') }}" class="card p-6 group hover:border-primary-200 hover:shadow-md transition-all duration-200">
            <div class="flex items-center gap-4">
                
                <div>
                    <p class="text-sm font-medium text-slate-500">Notifications</p>
                    <p class="text-lg font-semibold text-slate-800">View</p>
                </div>
            </div>
        </a>
        <a href="{{ route('activity') }}" class="card p-6 group hover:border-primary-200 hover:shadow-md transition-all duration-200">
            <div class="flex items-center gap-4">
                
                <div>
                    <p class="text-sm font-medium text-slate-500">Activity log</p>
                    <p class="text-lg font-semibold text-slate-800">View</p>
                </div>
            </div>
        </a>
    </div>

    <div class="card p-6">
        <h2 class="text-lg font-semibold text-slate-800 mb-4">Quick links</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('profile') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-primary-50 text-primary-700 text-sm font-medium hover:bg-primary-100 transition">Edit profile</a>
            <a href="{{ route('notifications') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-100 text-slate-700 text-sm font-medium hover:bg-slate-200 transition">Notifications</a>
            <a href="{{ route('activity') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-100 text-slate-700 text-sm font-medium hover:bg-slate-200 transition">Activity log</a>
        </div>
    </div>
</div>
