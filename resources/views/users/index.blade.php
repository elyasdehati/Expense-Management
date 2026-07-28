@extends('users.admin_master')
@section('user')

<section class="view-section active" id="view-dashboard">
     <h2 data-template-id="dashboard-heading" class="canva-text text-2xl font-bold mb-6"></h2><!-- Wallet Cards -->
     <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
      <div data-template-id="wallet-afn" class="canva-card wallet-card rounded-2xl p-5 bg-gradient-to-br from-indigo-600 to-purple-700 text-white">
       <p class="text-xs opacity-80 mb-1">AFN</p>
       <p class="text-2xl font-bold" id="bal-afn">{{ $balances['AFG'] }}</p>
       <p class="text-xs opacity-60 mt-2">Afghan Afghani</p>
      </div>
      <div data-template-id="wallet-usd" class="canva-card wallet-card rounded-2xl p-5 bg-gradient-to-br from-emerald-600 to-teal-700 text-white">
       <p class="text-xs opacity-80 mb-1">USD</p>
       <p class="text-2xl font-bold" id="bal-usd">{{ $balances['USD'] }}</p>
       <p class="text-xs opacity-60 mt-2">US Dollar</p>
      </div>
      <div data-template-id="wallet-eur" class="canva-card wallet-card rounded-2xl p-5 bg-gradient-to-br from-amber-500 to-orange-600 text-white">
       <p class="text-xs opacity-80 mb-1">EUR</p>
       <p class="text-2xl font-bold" id="bal-eur">{{ $balances['EUR'] }}</p>
       <p class="text-xs opacity-60 mt-2">Euro</p>
      </div>
     </div><!-- Exchange Rates -->
     <div data-template-id="exchange-rates-card" class="canva-card glass rounded-2xl p-5 mb-6">
      <div class="flex items-center justify-between mb-4">
       <h3 data-template-id="exchange-rates-title" class="canva-text text-sm font-semibold flex items-center gap-2"><i data-lucide="trending-up" style="width:16px;height:16px;color:#10b981"></i></h3><button id="refresh-rates-btn" class="p-1.5 rounded-lg hover:bg-white/10 transition text-xs opacity-60 hover:opacity-100" title="Refresh rates"><i data-lucide="rotate-cw" style="width:14px;height:14px"></i></button>
      </div>
      <div class="grid grid-cols-3 gap-3" id="rates-grid">
       <div class="bg-white/5 rounded-lg p-3">
        <p class="text-xs opacity-60 mb-1">1 USD →</p>
        <p class="text-sm font-bold text-emerald-400" id="rate-usd-afn">Loading...</p>
        <p class="text-xs opacity-50">AFN</p>
       </div>
       <div class="bg-white/5 rounded-lg p-3">
        <p class="text-xs opacity-60 mb-1">1 EUR →</p>
        <p class="text-sm font-bold text-amber-400" id="rate-eur-afn">Loading...</p>
        <p class="text-xs opacity-50">AFN</p>
       </div>
       <div class="bg-white/5 rounded-lg p-3">
        <p class="text-xs opacity-60 mb-1">1 EUR →</p>
        <p class="text-sm font-bold text-blue-400" id="rate-eur-usd">Loading...</p>
        <p class="text-xs opacity-50">USD</p>
       </div>
      </div>
      <p class="text-xs opacity-40 mt-3" id="rates-timestamp">Last updated: --</p>
     </div><!-- Stats Grid -->
    
     <!-- Charts -->

     <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
      <div class="card-bg rounded-xl p-4">
       <h4 data-template-id="analytics-section-title" class="canva-text text-sm font-semibold mb-3"></h4>
       <div style="height:380px; width:380px; margin:auto;">
            <canvas id="chart-income-expense"></canvas>
        </div>
      </div>
      <div class="card-bg rounded-xl p-4">
       <h4 class="text-sm font-semibold mb-3" data-i18n="chart_trend">Income vs Expenses</h4>
       <canvas id="chart-trend" height="200"></canvas>
      </div>
     </div><!-- Recent Transactions -->

     <div class="card-bg rounded-xl p-4">
      <h4 data-template-id="recent-section-title" class="canva-text text-sm font-semibold mb-3"></h4>
      <div id="recent-list" class="space-y-2 max-h-64 overflow-y-auto">
        @forelse($recentTransactions as $transaction)
        <div class="flex justify-between bg-white/5 rounded-lg p-3">
            <div>
                <p class="text-sm font-semibold">
                    {{ $transaction->category }}
                </p>
                <p class="text-xs opacity-60">
                    {{ $transaction->date }}
                </p>
            </div>
            <div class="text-right">
                <p class="font-bold {{ $transaction->type == 'Income' ? 'text-green-400' : 'text-red-400' }}">
                    {{ $transaction->type == 'Income' ? '+' : '-' }}
                    {{ $transaction->amount }}
                    {{ $transaction->currency }}
                </p>
                <p class="text-xs opacity-60">
                    {{ $transaction->type }}
                </p>
            </div>
        </div>
        @empty
        <p class="text-sm opacity-50 text-center py-4">
            No transactions yet
        </p>
        @endforelse
        </div>
     </div>

</section>

<script>

    async function loadRates() {
        let response = await fetch('https://api.exchangerate-api.com/v4/latest/USD');
        let data = await response.json();
        document.getElementById('rate-usd-afn').innerText =
            data.rates.AFN.toFixed(2);
        document.getElementById('rate-eur-afn').innerText =
            (data.rates.AFN / data.rates.EUR).toFixed(2);
        document.getElementById('rate-eur-usd').innerText =
            (1 / data.rates.EUR).toFixed(2);
        document.getElementById('rates-timestamp').innerText =
            "Last updated: " + new Date().toLocaleString();
    }

    // Chart Data
    let incomeValues = @json($incomeChart);
    let expenseValues = @json($expenseChart);

    // Make zero stay in the middle
    let maxValue = Math.max(
        Math.max(...incomeValues),
        Math.abs(Math.min(...expenseValues))
    );
    new Chart(document.getElementById('chart-trend'), {
        type: 'line',
        data: {
            labels: @json($chartDates),
            datasets: [
                {
                    label: 'Income',
                    data: incomeValues,
                    borderWidth: 3,
                    tension: 0.4,
                    fill: false
                },
                {
                    label: 'Expenses',
                    data: expenseValues,
                    borderWidth: 3,
                    tension: 0.4,
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            scales: {
                y: {
                    min: -maxValue,
                    max: maxValue,
                    ticks: {
                        callback: function(value) {
                            return value;
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.raw;
                        }
                    }
                }
            }
        }
    });

    new Chart(document.getElementById('chart-income-expense'), {
        type: 'pie',
        data: {
            labels: [
                'Income',
                'Expense'
            ],
            datasets: [
                {
                    data: [
                        {{ array_sum($incomeChart) }},
                        {{ abs(array_sum($expenseChart)) }}
                    ],
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.raw;
                        }
                    }
                }
            }
        }
    });

    loadRates();
    document.getElementById('refresh-rates-btn')
    .addEventListener('click', () => {
        loadRates();
    });
</script>

@endsection