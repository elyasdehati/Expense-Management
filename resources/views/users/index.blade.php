@extends('users.admin_master')
@section('user')

<section class="view-section active" id="view-dashboard">
     <h2 data-template-id="dashboard-heading" class="canva-text text-2xl font-bold mb-6"></h2><!-- Wallet Cards -->
     <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
      <div data-template-id="wallet-afn" class="canva-card wallet-card rounded-2xl p-5 bg-gradient-to-br from-indigo-600 to-purple-700 text-white">
       <p class="text-xs opacity-80 mb-1">AFN</p>
       <p class="text-2xl font-bold" id="bal-afn">0.00</p>
       <p class="text-xs opacity-60 mt-2">Afghan Afghani</p>
      </div>
      <div data-template-id="wallet-usd" class="canva-card wallet-card rounded-2xl p-5 bg-gradient-to-br from-emerald-600 to-teal-700 text-white">
       <p class="text-xs opacity-80 mb-1">USD</p>
       <p class="text-2xl font-bold" id="bal-usd">0.00</p>
       <p class="text-xs opacity-60 mt-2">US Dollar</p>
      </div>
      <div data-template-id="wallet-eur" class="canva-card wallet-card rounded-2xl p-5 bg-gradient-to-br from-amber-500 to-orange-600 text-white">
       <p class="text-xs opacity-80 mb-1">EUR</p>
       <p class="text-2xl font-bold" id="bal-eur">0.00</p>
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
     <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
      <div class="card-bg rounded-xl p-4">
       <p data-template-id="total-income-label" class="canva-text text-xs opacity-60"></p>
       <p class="text-lg font-bold mt-1" id="stat-income">0</p>
      </div>
      <div class="card-bg rounded-xl p-4">
       <p data-template-id="total-expenses-label" class="canva-text text-xs opacity-60"></p>
       <p class="text-lg font-bold mt-1" id="stat-expenses">0</p>
      </div>
      <div class="card-bg rounded-xl p-4">
       <p data-template-id="total-savings-label" class="canva-text text-xs opacity-60"></p>
       <p class="text-lg font-bold mt-1" id="stat-savings">0</p>
      </div>
      <div class="card-bg rounded-xl p-4">
       <p data-template-id="total-balance-label" class="canva-text text-xs opacity-60"></p>
       <p class="text-lg font-bold mt-1" id="stat-balance">0</p>
      </div>
     </div><!-- AI Insights -->
     <div data-template-id="ai-insight-card" class="canva-card glass rounded-2xl p-5 mb-6">
      <h3 data-template-id="ai-insight-title" class="canva-text text-sm font-semibold mb-2 flex items-center gap-2"><i data-lucide="sparkles" style="width:16px;height:16px;color:#a78bfa"></i></h3>
      <p class="text-sm opacity-80" id="ai-insight-text">Add transactions to receive personalized insights.</p>
     </div><!-- Charts -->
     <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
      <div class="card-bg rounded-xl p-4">
       <h4 data-template-id="analytics-section-title" class="canva-text text-sm font-semibold mb-3"></h4>
       <canvas id="chart-category" height="200"></canvas>
      </div>
      <div class="card-bg rounded-xl p-4">
       <h4 class="text-sm font-semibold mb-3" data-i18n="chart_trend">Income vs Expenses</h4>
       <canvas id="chart-trend" height="200"></canvas>
      </div>
     </div><!-- Recent Transactions -->
     <div class="card-bg rounded-xl p-4">
      <h4 data-template-id="recent-section-title" class="canva-text text-sm font-semibold mb-3"></h4>
      <div id="recent-list" class="space-y-2 max-h-64 overflow-y-auto">
       <p class="text-sm opacity-50 text-center py-4" data-i18n="no_transactions">No transactions yet</p>
      </div>
     </div>
</section>

@endsection