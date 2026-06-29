
<!doctype html>
<html lang="en" dir="ltr">
 <head><script src="/codelet/eyJhbGciOiJkaXIiLCJlbmMiOiJBMjU2R0NNIn0..Eq7TuFMyD1monHrC.a4V4417BR8RlFPCPUDHSHRjEW_jy51AL0RZLiOgb3aHzDcaMtJKLz-APQQ9KHkAulEqvfLGJYTUX1GHJqcD2mVB-ETOJCt6n6QeoAWIOOddlP9Dh-JH58To_Vb4vwYJYJCyrwWANhdizzbmoUpfYvGnEtV04GqN2N2XDqWLKDY-EoRcgIKBhqcynDBi0ZRNzSCNuegx5M73Ong._z5QVvWU18nyEXGxN9zWvA/telemetry_sdk.js?pin_id=9d8a080503ebe3e561f66727298173db"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hesabyar</title>
  <script src="https://cdn.tailwindcss.com/3.4.17"></script>
  <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
  <style>
        * { font-family: 'DM Sans', sans-serif; }
        .glass { background: rgba(255,255,255,0.08); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.12); }
        .dark .glass { background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.08); }
        .light .glass { background: rgba(255,255,255,0.7); border-color: rgba(0,0,0,0.08); backdrop-filter: blur(12px); }
        .sidebar-item { transition: all 0.2s; }
        .sidebar-item:hover, .sidebar-item.active { background: rgba(99,102,241,0.15); }
        .fade-in { animation: fadeIn 0.3s ease; }
        @keyframes fadeIn { from{opacity:0;transform:translateY(8px)} to{opacity:1;transform:translateY(0)} }
        .wallet-card { transition: transform 0.2s; }
        .wallet-card:hover { transform: translateY(-2px); }
        .progress-bar { transition: width 0.6s ease; }
        [dir="rtl"] .sidebar { border-left: 1px solid rgba(255,255,255,0.1); border-right: none; }
        .modal-overlay { transition: opacity 0.2s; }
        .view-section { display: none; }
        .view-section.active { display: block; }
        body.dark { background: #0f1117; color: #e2e8f0; }
        body.light { background: #f1f5f9; color: #1e293b; }
        .dark .card-bg { background: #1a1d2e; }
        .light .card-bg { background: #ffffff; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
    </style>
  <script>
    tailwind.config = { darkMode: 'class' }
    </script>
  <script src="/codelet/eyJhbGciOiJkaXIiLCJlbmMiOiJBMjU2R0NNIn0..Eq7TuFMyD1monHrC.a4V4417BR8RlFPCPUDHSHRjEW_jy51AL0RZLiOgb3aHzDcaMtJKLz-APQQ9KHkAulEqvfLGJYTUX1GHJqcD2mVB-ETOJCt6n6QeoAWIOOddlP9Dh-JH58To_Vb4vwYJYJCyrwWANhdizzbmoUpfYvGnEtV04GqN2N2XDqWLKDY-EoRcgIKBhqcynDBi0ZRNzSCNuegx5M73Ong._z5QVvWU18nyEXGxN9zWvA/resizing_sdk.js?pin_id=9d8a080503ebe3e561f66727298173db" type="text/javascript"></script>
 </head>
 <body data-template-id="__page-root" class="dark min-h-screen flex">

    <!-- Sidebar -->
        @include('users.body.sidebar')
    <!-- Left Sidebar End -->
  
  <!-- Main -->
  <div class="flex-1 flex flex-col overflow-hidden">

    <!-- Topbar Start -->
        @include('users.body.header')
    <!-- end Topbar -->
   
   <!-- Content -->
   <main class="flex-1 overflow-y-auto p-4 md:p-6" id="main-content">
    <!-- Dashboard View -->
    @yield('user')

    <!-- Income View -->
    <section class="view-section" id="view-income">
     <div class="flex items-center justify-between mb-6">
      <h2 class="text-2xl font-bold" data-i18n="nav_income">Income</h2><button onclick="openModal('income')" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium flex items-center gap-2"><i data-lucide="plus" style="width:16px;height:16px"></i><span data-i18n="add">Add</span></button>
     </div>
     <div id="income-list" class="space-y-2"></div>
    </section>

    <!-- Expenses View -->
    <section class="view-section" id="view-expenses">
     <div class="flex items-center justify-between mb-6">
      <h2 class="text-2xl font-bold" data-i18n="nav_expenses">Expenses</h2><button onclick="openModal('expense')" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium flex items-center gap-2"><i data-lucide="plus" style="width:16px;height:16px"></i><span data-i18n="add">Add</span></button>
     </div>
     <div id="expense-list" class="space-y-2"></div>
    </section>

    <!-- Savings View -->
    <section class="view-section" id="view-savings">
     <div class="flex items-center justify-between mb-6">
      <h2 data-template-id="savings-section-title" class="canva-text text-2xl font-bold"></h2><button onclick="openModal('saving_goal')" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium flex items-center gap-2"><i data-lucide="plus" style="width:16px;height:16px"></i><span data-i18n="new_goal">New Goal</span></button>
     </div>
     <div id="savings-list" class="space-y-3"></div>
    </section>

    <!-- Debts View -->
    <section class="view-section" id="view-debts">
     <div class="flex items-center justify-between mb-6">
      <h2 data-template-id="debts-section-title" class="canva-text text-2xl font-bold"></h2><button onclick="openModal('debt')" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium flex items-center gap-2"><i data-lucide="plus" style="width:16px;height:16px"></i><span data-i18n="add">Add</span></button>
     </div>
     <div id="debts-list" class="space-y-2"></div>
    </section>

    <!-- Budgets View -->
    <section class="view-section" id="view-budgets">
     <div class="flex items-center justify-between mb-6">
      <h2 data-template-id="budget-section-title" class="canva-text text-2xl font-bold"></h2><button onclick="openModal('budget')" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium flex items-center gap-2"><i data-lucide="plus" style="width:16px;height:16px"></i><span data-i18n="add">Add</span></button>
     </div>
     <div id="budgets-list" class="space-y-3"></div>
    </section>

    <!-- Reports View -->
    <section class="view-section" id="view-reports">
     <h2 class="text-2xl font-bold mb-6" data-i18n="nav_reports">Reports</h2>
     <div class="card-bg rounded-xl p-5">
      <canvas id="chart-reports" height="250"></canvas>
     </div>
    </section>
   </main>
  </div><!-- Modal -->
  <div id="modal-overlay" class="modal-overlay fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
   <div class="card-bg rounded-2xl p-6 w-full max-w-md max-h-[80vh] overflow-y-auto fade-in">
    <div class="flex items-center justify-between mb-4">
     <h3 id="modal-title" class="text-lg font-bold">Add</h3><button onclick="closeModal()" class="p-1"><i data-lucide="x" style="width:20px;height:20px"></i></button>
    </div>
    <form id="modal-form" class="space-y-3" onsubmit="handleSubmit(event)">
     <div id="form-fields"></div><button type="submit" id="modal-submit-btn" class="w-full py-2.5 bg-indigo-600 text-white rounded-lg font-medium text-sm">Save</button>
     <p id="form-error" class="text-red-400 text-xs hidden"></p>
     <p id="form-loading" class="text-indigo-400 text-xs hidden text-center">Saving...</p>
    </form>
   </div>
  </div>
  
  <!-- Mobile sidebar overlay -->
  <div id="mobile-sidebar" class="fixed inset-0 z-40 hidden">
   <div class="absolute inset-0 bg-black/50" onclick="closeMobileSidebar()"></div>
   <aside class="absolute left-0 top-0 bottom-0 w-64 bg-[#0f1117] p-4 flex flex-col" id="mobile-sidebar-content"></aside>
  </div>
  <script src="/codelet/eyJhbGciOiJkaXIiLCJlbmMiOiJBMjU2R0NNIn0..Eq7TuFMyD1monHrC.a4V4417BR8RlFPCPUDHSHRjEW_jy51AL0RZLiOgb3aHzDcaMtJKLz-APQQ9KHkAulEqvfLGJYTUX1GHJqcD2mVB-ETOJCt6n6QeoAWIOOddlP9Dh-JH58To_Vb4vwYJYJCyrwWANhdizzbmoUpfYvGnEtV04GqN2N2XDqWLKDY-EoRcgIKBhqcynDBi0ZRNzSCNuegx5M73Ong._z5QVvWU18nyEXGxN9zWvA/editing_sdk.js?pin_id=9d8a080503ebe3e561f66727298173db"></script>
  <script src="/codelet/eyJhbGciOiJkaXIiLCJlbmMiOiJBMjU2R0NNIn0..Eq7TuFMyD1monHrC.a4V4417BR8RlFPCPUDHSHRjEW_jy51AL0RZLiOgb3aHzDcaMtJKLz-APQQ9KHkAulEqvfLGJYTUX1GHJqcD2mVB-ETOJCt6n6QeoAWIOOddlP9Dh-JH58To_Vb4vwYJYJCyrwWANhdizzbmoUpfYvGnEtV04GqN2N2XDqWLKDY-EoRcgIKBhqcynDBi0ZRNzSCNuegx5M73Ong._z5QVvWU18nyEXGxN9zWvA/data_sdk.js?pin_id=9d8a080503ebe3e561f66727298173db"></script>
  <script>
// State
let allData = [];
let currentLang = 'en';
let currentTheme = 'dark';
let currentModal = null;
let categoryChart = null;
let trendChart = null;
let reportsChart = null;

// i18n
const translations = {
    en: {
        nav_dashboard: 'Dashboard', nav_income: 'Income', nav_expenses: 'Expenses',
        nav_savings: 'Savings', nav_debts: 'Loans & Debts', nav_budgets: 'Budgets',
        nav_reports: 'Reports', add: 'Add', new_goal: 'New Goal',
        amount: 'Amount', currency: 'Currency', category: 'Category', source: 'Source',
        notes: 'Notes', date: 'Date', person_name: 'Person Name', phone: 'Phone',
        due_date: 'Due Date', goal_name: 'Goal Name', target_amount: 'Target Amount',
        budget_limit: 'Budget Limit', period: 'Period', monthly: 'Monthly', yearly: 'Yearly',
        no_transactions: 'No transactions yet', delete_confirm: 'Delete?', yes: 'Yes', cancel: 'Cancel',
        chart_trend: 'Income vs Expenses', borrowed: 'Borrowed', lent: 'Lent',
        status: 'Status', active: 'Active', paid: 'Paid', save: 'Save',
        type_borrowed: 'I Borrowed', type_lent: 'I Lent', deposit: 'Deposit', withdraw: 'Withdraw',
        ai_no_data: 'Add transactions to receive personalized insights.',
        limit_warning: 'Storage limit reached (999 records). Please delete some items.'
    },
    fa: {
        nav_dashboard: 'داشبورد', nav_income: 'درآمد', nav_expenses: 'مصارف',
        nav_savings: 'پس‌انداز', nav_debts: 'قرض‌ها', nav_budgets: 'بودجه',
        nav_reports: 'گزارش‌ها', add: 'افزودن', new_goal: 'هدف جدید',
        amount: 'مبلغ', currency: 'ارز', category: 'دسته‌بندی', source: 'منبع',
        notes: 'یادداشت', date: 'تاریخ', person_name: 'نام شخص', phone: 'تلفن',
        due_date: 'سررسید', goal_name: 'نام هدف', target_amount: 'مبلغ هدف',
        budget_limit: 'سقف بودجه', period: 'دوره', monthly: 'ماهانه', yearly: 'سالانه',
        no_transactions: 'هنوز معامله‌ای ثبت نشده', delete_confirm: 'حذف شود؟', yes: 'بلی', cancel: 'لغو',
        chart_trend: 'درآمد در مقابل مصارف', borrowed: 'قرض گرفته', lent: 'قرض داده',
        status: 'وضعیت', active: 'فعال', paid: 'پرداخت شده', save: 'ذخیره',
        type_borrowed: 'قرض گرفتم', type_lent: 'قرض دادم', deposit: 'واریز', withdraw: 'برداشت',
        ai_no_data: 'معاملات اضافه کنید تا توصیه‌های مالی دریافت کنید.',
        limit_warning: 'به حد ذخیره‌سازی (۹۹۹) رسیده‌اید. لطفاً بعضی موارد را حذف کنید.'
    }
};

function t(key) { return translations[currentLang][key] || key; }

function updateLanguage() {
    const dir = currentLang === 'fa' ? 'rtl' : 'ltr';
    document.documentElement.dir = dir;
    document.documentElement.lang = currentLang === 'fa' ? 'fa' : 'en';
    document.querySelectorAll('[data-i18n]').forEach(el => {
        el.textContent = t(el.dataset.i18n);
    });
}

// Theme
function toggleTheme() {
    currentTheme = currentTheme === 'dark' ? 'light' : 'dark';
    document.body.classList.remove('dark', 'light');
    document.body.classList.add(currentTheme);
    document.getElementById('theme-icon').setAttribute('data-lucide', currentTheme === 'dark' ? 'sun' : 'moon');
    lucide.createIcons();
}

// Navigation
function switchView(view) {
    document.querySelectorAll('.view-section').forEach(s => s.classList.remove('active'));
    document.getElementById('view-' + view)?.classList.add('active');
    document.querySelectorAll('.sidebar-item').forEach(b => b.classList.remove('active'));
    document.querySelector(`[data-view="${view}"]`)?.classList.add('active');
    closeMobileSidebar();
}

document.getElementById('sidebar-nav').addEventListener('click', e => {
    const btn = e.target.closest('[data-view]');
    if (btn) switchView(btn.dataset.view);
});

// Mobile sidebar
document.getElementById('mobile-menu-btn').addEventListener('click', () => {
    const ms = document.getElementById('mobile-sidebar');
    ms.classList.remove('hidden');
    const content = document.getElementById('mobile-sidebar-content');
    content.innerHTML = document.querySelector('.sidebar').innerHTML;
    content.querySelectorAll('[data-view]').forEach(btn => {
        btn.addEventListener('click', () => switchView(btn.dataset.view));
    });
    lucide.createIcons();
});
function closeMobileSidebar() { document.getElementById('mobile-sidebar').classList.add('hidden'); }

// Lang toggle
document.getElementById('lang-toggle').addEventListener('click', () => {
    currentLang = currentLang === 'en' ? 'fa' : 'en';
    updateLanguage();
    renderAll();
});

document.getElementById('theme-toggle').addEventListener('click', toggleTheme);

// Exchange rates refresh button
document.getElementById('refresh-rates-btn').addEventListener('click', fetchExchangeRates);

// Modal
const formConfigs = {
    income: ['amount', 'currency', 'category', 'source', 'notes', 'date'],
    expense: ['amount', 'currency', 'category', 'notes', 'date'],
    saving_goal: ['goal_name', 'target_amount', 'currency'],
    saving_deposit: ['amount', 'currency', 'goal_name', 'date'],
    debt: ['person_name', 'phone', 'amount', 'currency', 'notes', 'due_date', 'date'],
    budget: ['category', 'budget_limit', 'currency', 'period']
};

const categoryOptions = {
    income: ['Salary', 'Freelancing', 'Business', 'Investments', 'Gifts', 'Bonuses', 'Other'],
    expense: ['Food', 'Transport', 'Education', 'Health', 'Shopping', 'Entertainment', 'Travel', 'Bills', 'Rent', 'Business', 'Family', 'Other']
};

function openModal(type) {
    currentModal = type;
    document.getElementById('modal-title').textContent = t('add') + ' - ' + t('nav_' + (type === 'expense' ? 'expenses' : type === 'saving_goal' || type === 'saving_deposit' ? 'savings' : type === 'debt' ? 'debts' : type === 'budget' ? 'budgets' : type));
    const fields = formConfigs[type] || [];
    const container = document.getElementById('form-fields');
    container.innerHTML = '';

    if (type === 'debt') {
        container.innerHTML += `<div class="flex gap-2 mb-2">
            <label class="flex-1"><input type="radio" name="debt_type" value="debt_borrowed" checked> ${t('type_borrowed')}</label>
            <label class="flex-1"><input type="radio" name="debt_type" value="debt_lent"> ${t('type_lent')}</label>
        </div>`;
    }

    fields.forEach(f => {
        let input = '';
        if (f === 'currency') {
            input = `<select name="${f}" class="w-full p-2.5 rounded-lg bg-white/5 border border-white/10 text-sm"><option value="AFN">AFN</option><option value="USD">USD</option><option value="EUR">EUR</option></select>`;
        } else if (f === 'category' && categoryOptions[type]) {
            input = `<select name="${f}" class="w-full p-2.5 rounded-lg bg-white/5 border border-white/10 text-sm">${categoryOptions[type].map(c => `<option value="${c}">${c}</option>`).join('')}</select>`;
        } else if (f === 'period') {
            input = `<select name="${f}" class="w-full p-2.5 rounded-lg bg-white/5 border border-white/10 text-sm"><option value="monthly">${t('monthly')}</option><option value="yearly">${t('yearly')}</option></select>`;
        } else if (f === 'date' || f === 'due_date') {
            input = `<input type="date" name="${f}" class="w-full p-2.5 rounded-lg bg-white/5 border border-white/10 text-sm" value="${new Date().toISOString().split('T')[0]}">`;
        } else if (f === 'notes') {
            input = `<textarea name="${f}" class="w-full p-2.5 rounded-lg bg-white/5 border border-white/10 text-sm" rows="2" placeholder="${t(f)}"></textarea>`;
        } else {
            const inputType = ['amount', 'target_amount', 'budget_limit'].includes(f) ? 'number' : f === 'phone' ? 'tel' : 'text';
            input = `<input type="${inputType}" name="${f}" class="w-full p-2.5 rounded-lg bg-white/5 border border-white/10 text-sm" placeholder="${t(f)}" ${['amount','target_amount','budget_limit'].includes(f) ? 'step="0.01" min="0"' : ''}>`;
        }
        container.innerHTML += `<label class="block mb-1 text-xs opacity-60">${t(f)}</label>${input}<div class="mb-2"></div>`;
    });

    document.getElementById('modal-overlay').classList.remove('hidden');
    document.getElementById('form-error').classList.add('hidden');
    document.getElementById('form-loading').classList.add('hidden');
}

function closeModal() {
    document.getElementById('modal-overlay').classList.add('hidden');
    currentModal = null;
}

async function handleSubmit(e) {
    e.preventDefault();
    if (allData.length >= 999) {
        document.getElementById('form-error').textContent = t('limit_warning');
        document.getElementById('form-error').classList.remove('hidden');
        return;
    }

    const form = e.target;
    const fd = new FormData(form);
    const record = { type: currentModal };

    if (currentModal === 'debt') {
        record.type = fd.get('debt_type') || 'debt_borrowed';
    }

    const fields = formConfigs[currentModal] || [];
    fields.forEach(f => {
        const val = fd.get(f);
        if (['amount', 'target_amount', 'budget_limit'].includes(f)) {
            record[f] = parseFloat(val) || 0;
        } else {
            record[f] = val || '';
        }
    });

    if (!record.date) record.date = new Date().toISOString();
    record.status = 'active';

    document.getElementById('form-loading').classList.remove('hidden');
    document.getElementById('modal-submit-btn').disabled = true;

    const result = await window.dataSdk.create(record);

    document.getElementById('form-loading').classList.add('hidden');
    document.getElementById('modal-submit-btn').disabled = false;

    if (result.isOk) {
        closeModal();
    } else {
        document.getElementById('form-error').textContent = 'Error saving. Please try again.';
        document.getElementById('form-error').classList.remove('hidden');
    }
}

// Delete
async function deleteRecord(record) {
    const el = document.querySelector(`[data-record-id="${record.__backendId}"]`);
    if (el && !el.dataset.confirming) {
        el.dataset.confirming = 'true';
        const origHTML = el.innerHTML;
        el.innerHTML = `<span class="text-sm">${t('delete_confirm')}</span>
            <button class="px-2 py-1 bg-red-600 text-white rounded text-xs confirm-yes">${t('yes')}</button>
            <button class="px-2 py-1 bg-gray-600 text-white rounded text-xs confirm-no">${t('cancel')}</button>`;
        el.querySelector('.confirm-yes').onclick = async () => {
            const r = await window.dataSdk.delete(record);
            if (!r.isOk) { el.innerHTML = origHTML; delete el.dataset.confirming; }
        };
        el.querySelector('.confirm-no').onclick = () => { el.innerHTML = origHTML; delete el.dataset.confirming; };
    }
}

// Exchange Rates
async function fetchExchangeRates() {
    try {
        const response = await fetch('https://api.exchangerate-api.com/v4/latest/AFN');
        const data = await response.json();
        const rates = data.rates;
        
        document.getElementById('rate-usd-afn').textContent = (rates.USD ? (1 / rates.USD).toFixed(2) : 'N/A');
        document.getElementById('rate-eur-afn').textContent = (rates.EUR ? (1 / rates.EUR).toFixed(2) : 'N/A');
        document.getElementById('rate-eur-usd').textContent = (rates.USD && rates.EUR ? (rates.USD / rates.EUR).toFixed(4) : 'N/A');
        
        const now = new Date();
        const timeStr = now.toLocaleTimeString(currentLang === 'fa' ? 'fa-IR' : 'en-US', { hour: '2-digit', minute: '2-digit' });
        document.getElementById('rates-timestamp').textContent = `Last updated: ${timeStr}`;
    } catch (error) {
        console.error('Failed to fetch rates:', error);
        document.getElementById('rate-usd-afn').textContent = 'Error';
        document.getElementById('rate-eur-afn').textContent = 'Error';
        document.getElementById('rate-eur-usd').textContent = 'Error';
    }
}

// Rendering
function renderAll() {
    renderDashboard();
    renderIncomeList();
    renderExpenseList();
    renderSavingsList();
    renderDebtsList();
    renderBudgetsList();
    renderCharts();
}

function renderDashboard() {
    const incomes = allData.filter(d => d.type === 'income');
    const expenses = allData.filter(d => d.type === 'expense');
    const savingGoals = allData.filter(d => d.type === 'saving_goal');
    const savingDeposits = allData.filter(d => d.type === 'saving_deposit');

    const totalIncome = incomes.reduce((s, d) => s + (d.amount || 0), 0);
    const totalExpenses = expenses.reduce((s, d) => s + (d.amount || 0), 0);
    const totalSavings = savingDeposits.reduce((s, d) => s + (d.amount || 0), 0);

    document.getElementById('stat-income').textContent = totalIncome.toLocaleString();
    document.getElementById('stat-expenses').textContent = totalExpenses.toLocaleString();
    document.getElementById('stat-savings').textContent = totalSavings.toLocaleString();
    document.getElementById('stat-balance').textContent = (totalIncome - totalExpenses).toLocaleString();

    // Balances by currency
    ['AFN', 'USD', 'EUR'].forEach(cur => {
        const inc = incomes.filter(d => d.currency === cur).reduce((s, d) => s + (d.amount || 0), 0);
        const exp = expenses.filter(d => d.currency === cur).reduce((s, d) => s + (d.amount || 0), 0);
        document.getElementById('bal-' + cur.toLowerCase()).textContent = (inc - exp).toLocaleString(undefined, {minimumFractionDigits: 2});
    });

    // Recent transactions
    const recent = [...incomes, ...expenses].sort((a, b) => (b.date || '').localeCompare(a.date || '')).slice(0, 5);
    const recentEl = document.getElementById('recent-list');
    if (recent.length === 0) {
        recentEl.innerHTML = `<p class="text-sm opacity-50 text-center py-4">${t('no_transactions')}</p>`;
    } else {
        recentEl.innerHTML = recent.map(r => `
            <div class="flex items-center justify-between py-2 border-b border-white/5">
                <div>
                    <p class="text-sm font-medium">${r.category || r.source || ''}</p>
                    <p class="text-xs opacity-50">${r.date ? r.date.split('T')[0] : ''}</p>
                </div>
                <span class="text-sm font-bold ${r.type === 'income' ? 'text-emerald-400' : 'text-red-400'}">${r.type === 'income' ? '+' : '-'}${(r.amount || 0).toLocaleString()} ${r.currency || ''}</span>
            </div>`).join('');
    }

    // AI Insight
    generateAIInsight(incomes, expenses, totalIncome, totalExpenses);
}

function generateAIInsight(incomes, expenses, totalIncome, totalExpenses) {
    const el = document.getElementById('ai-insight-text');
    if (allData.length < 3) { el.textContent = t('ai_no_data'); return; }

    const insights = [];
    if (totalExpenses > totalIncome * 0.9) insights.push(currentLang === 'fa' ? 'مصارف شما بسیار نزدیک به درآمدتان است. سعی کنید ۲۰٪ پس‌انداز کنید.' : 'Your expenses are close to your income. Try to save at least 20%.');
    const topCat = expenses.reduce((acc, e) => { acc[e.category] = (acc[e.category] || 0) + (e.amount || 0); return acc; }, {});
    const sorted = Object.entries(topCat).sort((a, b) => b[1] - a[1]);
    if (sorted.length > 0) insights.push(currentLang === 'fa' ? `بیشترین مصرف شما در "${sorted[0][0]}" است.` : `Your top spending category is "${sorted[0][0]}".`);
    if (totalIncome > totalExpenses * 1.5) insights.push(currentLang === 'fa' ? 'وضعیت مالی شما خوب است! به پس‌انداز ادامه دهید.' : 'Your financial health looks good! Keep saving.');

    el.textContent = insights.length > 0 ? insights.join(' ') : t('ai_no_data');
}

function renderList(containerId, items, renderItem) {
    const container = document.getElementById(containerId);
    if (items.length === 0) {
        container.innerHTML = `<p class="text-sm opacity-50 text-center py-8">${t('no_transactions')}</p>`;
        return;
    }
    container.innerHTML = items.map(renderItem).join('');
}

function renderIncomeList() {
    renderList('income-list', allData.filter(d => d.type === 'income').sort((a, b) => (b.date || '').localeCompare(a.date || '')),
        r => `<div data-record-id="${r.__backendId}" class="card-bg rounded-lg p-3 flex items-center justify-between">
            <div><p class="text-sm font-medium">${r.source || r.category || ''}</p><p class="text-xs opacity-50">${r.date?.split('T')[0] || ''} · ${r.category || ''}</p></div>
            <div class="flex items-center gap-2"><span class="text-emerald-400 font-bold text-sm">+${(r.amount||0).toLocaleString()} ${r.currency||''}</span>
            <button onclick='deleteRecord(${JSON.stringify(r)})' class="p-1 opacity-50 hover:opacity-100"><i data-lucide="trash-2" style="width:14px;height:14px"></i></button></div></div>`);
    lucide.createIcons();
}

function renderExpenseList() {
    renderList('expense-list', allData.filter(d => d.type === 'expense').sort((a, b) => (b.date || '').localeCompare(a.date || '')),
        r => `<div data-record-id="${r.__backendId}" class="card-bg rounded-lg p-3 flex items-center justify-between">
            <div><p class="text-sm font-medium">${r.category || ''}</p><p class="text-xs opacity-50">${r.date?.split('T')[0] || ''}</p></div>
            <div class="flex items-center gap-2"><span class="text-red-400 font-bold text-sm">-${(r.amount||0).toLocaleString()} ${r.currency||''}</span>
            <button onclick='deleteRecord(${JSON.stringify(r)})' class="p-1 opacity-50 hover:opacity-100"><i data-lucide="trash-2" style="width:14px;height:14px"></i></button></div></div>`);
    lucide.createIcons();
}

function renderSavingsList() {
    const goals = allData.filter(d => d.type === 'saving_goal');
    const deposits = allData.filter(d => d.type === 'saving_deposit');
    const container = document.getElementById('savings-list');
    if (goals.length === 0) { container.innerHTML = `<p class="text-sm opacity-50 text-center py-8">${t('no_transactions')}</p>`; return; }
    container.innerHTML = goals.map(g => {
        const saved = deposits.filter(d => d.goal_name === g.goal_name).reduce((s, d) => s + (d.amount || 0), 0);
        const target = g.target_amount || 1;
        const pct = Math.min(100, Math.round(saved / target * 100));
        return `<div class="card-bg rounded-xl p-4">
            <div class="flex justify-between items-center mb-2">
                <p class="font-semibold text-sm">${g.goal_name || ''}</p>
                <span class="text-xs opacity-60">${saved.toLocaleString()} / ${target.toLocaleString()} ${g.currency || ''}</span>
            </div>
            <div class="w-full h-2 rounded-full bg-white/10 overflow-hidden"><div class="progress-bar h-full rounded-full bg-gradient-to-r from-indigo-500 to-purple-500" style="width:${pct}%"></div></div>
            <div class="flex justify-between mt-2">
                <span class="text-xs opacity-50">${pct}%</span>
                <button onclick="openModal('saving_deposit')" class="text-xs text-indigo-400">${t('deposit')}</button>
            </div></div>`;
    }).join('');
}

function renderDebtsList() {
    const debts = allData.filter(d => d.type === 'debt_borrowed' || d.type === 'debt_lent').sort((a, b) => (b.date || '').localeCompare(a.date || ''));
    renderList('debts-list', debts, r => `<div data-record-id="${r.__backendId}" class="card-bg rounded-lg p-3 flex items-center justify-between">
        <div><p class="text-sm font-medium">${r.person_name || ''}</p><p class="text-xs opacity-50">${r.type === 'debt_borrowed' ? t('borrowed') : t('lent')} · ${r.due_date?.split('T')[0] || ''}</p></div>
        <div class="flex items-center gap-2"><span class="font-bold text-sm ${r.type === 'debt_borrowed' ? 'text-red-400' : 'text-emerald-400'}">${(r.amount||0).toLocaleString()} ${r.currency||''}</span>
        <button onclick='deleteRecord(${JSON.stringify(r)})' class="p-1 opacity-50 hover:opacity-100"><i data-lucide="trash-2" style="width:14px;height:14px"></i></button></div></div>`);
    lucide.createIcons();
}

function renderBudgetsList() {
    const budgets = allData.filter(d => d.type === 'budget');
    const expenses = allData.filter(d => d.type === 'expense');
    const container = document.getElementById('budgets-list');
    if (budgets.length === 0) { container.innerHTML = `<p class="text-sm opacity-50 text-center py-8">${t('no_transactions')}</p>`; return; }
    container.innerHTML = budgets.map(b => {
        const spent = expenses.filter(e => e.category === b.category && e.currency === b.currency).reduce((s, e) => s + (e.amount || 0), 0);
        const limit = b.budget_limit || 1;
        const pct = Math.min(100, Math.round(spent / limit * 100));
        const color = pct > 90 ? 'from-red-500 to-red-600' : pct > 70 ? 'from-amber-500 to-orange-500' : 'from-emerald-500 to-teal-500';
        return `<div class="card-bg rounded-xl p-4">
            <div class="flex justify-between items-center mb-2">
                <p class="font-semibold text-sm">${b.category || ''} <span class="text-xs opacity-50">(${b.period || ''})</span></p>
                <span class="text-xs opacity-60">${spent.toLocaleString()} / ${limit.toLocaleString()} ${b.currency || ''}</span>
            </div>
            <div class="w-full h-2 rounded-full bg-white/10 overflow-hidden"><div class="progress-bar h-full rounded-full bg-gradient-to-r ${color}" style="width:${pct}%"></div></div>
            <p class="text-xs mt-1 opacity-50">${pct}% ${currentLang === 'fa' ? 'مصرف شده' : 'used'}</p></div>`;
    }).join('');
}

function renderCharts() {
    const expenses = allData.filter(d => d.type === 'expense');
    const incomes = allData.filter(d => d.type === 'income');

    // Category donut
    const catData = expenses.reduce((acc, e) => { acc[e.category || 'Other'] = (acc[e.category || 'Other'] || 0) + (e.amount || 0); return acc; }, {});
    const catLabels = Object.keys(catData);
    const catValues = Object.values(catData);
    const colors = ['#6366f1','#8b5cf6','#ec4899','#f59e0b','#10b981','#3b82f6','#ef4444','#14b8a6','#f97316','#64748b','#a855f7','#06b6d4'];

    if (categoryChart) categoryChart.destroy();
    const ctx1 = document.getElementById('chart-category');
    if (ctx1) {
        categoryChart = new Chart(ctx1, {
            type: 'doughnut', data: { labels: catLabels, datasets: [{ data: catValues, backgroundColor: colors.slice(0, catLabels.length), borderWidth: 0 }] },
            options: { responsive: true, plugins: { legend: { position: 'bottom', labels: { color: currentTheme === 'dark' ? '#94a3b8' : '#475569', font: { size: 11 } } } } }
        });
    }

    // Trend (last 6 months)
    const months = [];
    const now = new Date();
    for (let i = 5; i >= 0; i--) { const d = new Date(now.getFullYear(), now.getMonth() - i, 1); months.push(d.toISOString().slice(0, 7)); }
    const incByMonth = months.map(m => incomes.filter(d => (d.date || '').startsWith(m)).reduce((s, d) => s + (d.amount || 0), 0));
    const expByMonth = months.map(m => expenses.filter(d => (d.date || '').startsWith(m)).reduce((s, d) => s + (d.amount || 0), 0));

    if (trendChart) trendChart.destroy();
    const ctx2 = document.getElementById('chart-trend');
    if (ctx2) {
        trendChart = new Chart(ctx2, {
            type: 'line', data: { labels: months, datasets: [
                { label: t('nav_income'), data: incByMonth, borderColor: '#10b981', backgroundColor: 'rgba(16,185,129,0.1)', fill: true, tension: 0.4 },
                { label: t('nav_expenses'), data: expByMonth, borderColor: '#ef4444', backgroundColor: 'rgba(239,68,68,0.1)', fill: true, tension: 0.4 }
            ]}, options: { responsive: true, scales: { x: { ticks: { color: '#64748b' } }, y: { ticks: { color: '#64748b' } } }, plugins: { legend: { labels: { color: currentTheme === 'dark' ? '#94a3b8' : '#475569' } } } }
        });
    }

    // Reports chart
    if (reportsChart) reportsChart.destroy();
    const ctx3 = document.getElementById('chart-reports');
    if (ctx3) {
        reportsChart = new Chart(ctx3, {
            type: 'bar', data: { labels: months, datasets: [
                { label: t('nav_income'), data: incByMonth, backgroundColor: '#6366f1' },
                { label: t('nav_expenses'), data: expByMonth, backgroundColor: '#f43f5e' }
            ]}, options: { responsive: true, scales: { x: { ticks: { color: '#64748b' } }, y: { ticks: { color: '#64748b' } } }, plugins: { legend: { labels: { color: currentTheme === 'dark' ? '#94a3b8' : '#475569' } } } }
        });
    }
}

// Data SDK
const dataHandler = {
    onDataChanged(data) {
        allData = data;
        renderAll();
    }
};

(async () => {
    const result = await window.dataSdk.init(dataHandler);
    if (!result.isOk) console.error('Data SDK init failed');
    lucide.createIcons();
    updateLanguage();
    fetchExchangeRates();
    setInterval(fetchExchangeRates, 300000); // Refresh every 5 minutes
})();
</script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    lucide.createIcons();
  });
</script>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'a0b00204c5242923',t:'MTc4MTM0MjMwNi4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>