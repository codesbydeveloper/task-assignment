<div class="space-y-8">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Admin dashboard</h1>
        <p class="mt-1 text-slate-500">System stats and overview.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5">
        <div class="card p-5">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-primary-100 text-primary-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Total users</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="card p-5">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Active users</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $activeUsers }}</p>
                </div>
            </div>
        </div>
        <div class="card p-5">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-sky-100 text-sky-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Total transactions</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $totalTransactions }}</p>
                </div>
            </div>
        </div>
        <div class="card p-5">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Today's reports</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $dailyReports }}</p>
                </div>
            </div>
        </div>
        <div class="card p-5">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Queue pending</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $queuePending }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card p-6">
        <h2 class="text-lg font-semibold text-slate-800 mb-4">Users &amp; transactions</h2>
        <canvas id="users-transactions-chart" class="w-full h-64" wire:ignore></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function renderUsersTransactionsChart() {
            const canvas = document.getElementById('users-transactions-chart');
            if (!canvas || canvas.dataset.initialized === '1') return;
            canvas.dataset.initialized = '1';
            new Chart(canvas.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['Total Users', 'Active Users', 'Transactions'],
                    datasets: [{
                        label: 'Count',
                        data: [{{ $totalUsers }}, {{ $activeUsers }}, {{ $totalTransactions }}],
                        backgroundColor: ['#6366f1', '#22c55e', '#0ea5e9'],
                    }],
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, ticks: { precision: 0 } } },
                },
            });
        }
        document.addEventListener('DOMContentLoaded', renderUsersTransactionsChart);
        document.addEventListener('livewire:navigated', renderUsersTransactionsChart);
    </script>
</div>
