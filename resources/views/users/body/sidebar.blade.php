<aside class="sidebar w-64 border-r border-white/10 p-4 flex-shrink-0 hidden md:flex flex-col" style="min-height:calc(100 * min(var(--vh,1vh),1vh))">
   <div class="mb-8">
    <h1 data-template-id="app-title" class="canva-text text-xl font-bold text-indigo-400"></h1>
   </div>
   <nav class="flex-1 space-y-1" id="sidebar-nav">

      <a href="{{ route('dashboard') }}" class="sidebar-item w-full text-left px-3 py-2.5 rounded-lg flex items-center gap-3 text-sm">
       <i data-lucide="layout-dashboard" style="width:18px;height:18px"></i>
       <span data-i18n="nav_dashboard">Dashboard</span>
      </a> 
      
      <a href="{{ route('all.income') }}"
         class="sidebar-item w-full text-left px-3 py-2.5 rounded-lg flex items-center gap-3 text-sm">
         <i data-lucide="trending-up" style="width:18px;height:18px"></i>
         <span>Income</span>
      </a>
      
      <a href="{{ route('all.expense') }}"
         class="sidebar-item w-full text-left px-3 py-2.5 rounded-lg flex items-center gap-3 text-sm">
         <i data-lucide="trending-down" style="width:18px;height:18px"></i>
         <span data-i18n="nav_expenses">Expenses</span> 
      </a>
      
      <button class="sidebar-item w-full text-left px-3 py-2.5 rounded-lg flex items-center gap-3 text-sm" data-view="savings"> 
         <i data-lucide="piggy-bank" style="width:18px;height:18px"></i>
         <span data-i18n="nav_savings">Savings</span> 
      </button> 
      
      <button class="sidebar-item w-full text-left px-3 py-2.5 rounded-lg flex items-center gap-3 text-sm" data-view="debts"> 
         <i data-lucide="handshake" style="width:18px;height:18px"></i>
         <span data-i18n="nav_debts">Loans &amp; Debts</span> 
      </button> 
      
      <button class="sidebar-item w-full text-left px-3 py-2.5 rounded-lg flex items-center gap-3 text-sm" data-view="budgets"> 
         <i data-lucide="target" style="width:18px;height:18px"></i>
         <span data-i18n="nav_budgets">Budgets</span> 
      </button> 
      
      <button class="sidebar-item w-full text-left px-3 py-2.5 rounded-lg flex items-center gap-3 text-sm" data-view="reports"> 
         <i data-lucide="bar-chart-3" style="width:18px;height:18px"></i>
         <span data-i18n="nav_reports">Reports</span> 
      </button>
   </nav>
  </aside>