<div class="space-y-8">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Admin dashboard</h1>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5">
        <div class="card p-5">
            <div class="flex items-center gap-3">
                
                <div>
                    <p class="text-sm font-medium text-slate-500">Total users</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="card p-5">
            <div class="flex items-center gap-3">
                
                <div>
                    <p class="text-sm font-medium text-slate-500">Active users</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $activeUsers }}</p>
                </div>
            </div>
        </div>
        <div class="card p-5">
            <div class="flex items-center gap-3">
                
                <div>
                    <p class="text-sm font-medium text-slate-500">Total transactions</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $totalTransactions }}</p>
                </div>
            </div>
        </div>
        <div class="card p-5">
            <div class="flex items-center gap-3">
              
                <div>
                    <p class="text-sm font-medium text-slate-500">Today's reports</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $dailyReports }}</p>
                </div>
            </div>
        </div>
        <div class="card p-5">
            <div class="flex items-center gap-3">
               
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
