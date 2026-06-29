<header class="flex items-center justify-between px-4 md:px-6 py-3 border-b border-white/10">
    <button id="mobile-menu-btn" class="md:hidden p-2">
        <i data-lucide="menu" style="width:20px;height:20px"></i>
    </button>

    <div class="flex items-center gap-2">
        <button id="lang-toggle" class="px-3 py-1.5 rounded-lg glass text-xs font-medium">
            EN / دری
        </button>

        <button id="theme-toggle" class="p-2 rounded-lg glass">
            <i data-lucide="sun" style="width:16px;height:16px" id="theme-icon"></i>
        </button>
    </div>

    <!-- Logout button (ONLY ADD) -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-500/20 text-red-400 hover:bg-red-500/30 transition text-xs font-medium flex items-center gap-1">
            <i data-lucide="log-out" style="width:16px;height:16px"></i>
            Logout
        </button>
    </form>
</header>