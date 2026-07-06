@extends('users.admin_master')

@section('user')

<section id="view-savings">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Savings</h2>

        <button onclick="openModal()"
            class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium flex items-center gap-2">
            <i data-lucide="plus" style="width:16px;height:16px"></i>
            Add
        </button>
    </div>

    <!-- FILTER -->
    <form method="GET" class="flex flex-wrap gap-3 mb-6">

        <select name="currency"
            class="p-2 rounded-lg bg-white/5 border border-white/10 text-white">
            <option value="" {{ request('currency') == '' ? 'selected' : '' }}>All Currency</option>
            <option value="AFG" {{ request('currency') == 'AFG' ? 'selected' : '' }}>AFG</option>
            <option value="USD" {{ request('currency') == 'USD' ? 'selected' : '' }}>USD</option>
            <option value="EUR" {{ request('currency') == 'EUR' ? 'selected' : '' }}>EUR</option>
        </select>

        <select name="period"
            class="p-2 rounded-lg bg-white/5 border border-white/10 text-white">
            <option value="all" {{ request('period') == 'all' || request('period') == null ? 'selected' : '' }}>All Time</option>
            <option value="daily" {{ request('period') == 'daily' ? 'selected' : '' }}>Daily</option>
            <option value="monthly" {{ request('period') == 'monthly' ? 'selected' : '' }}>Monthly</option>
            <option value="last_month" {{ request('period') == 'last_month' ? 'selected' : '' }}>Last Month</option>
            <option value="yearly" {{ request('period') == 'yearly' ? 'selected' : '' }}>Yearly</option>
            <option value="last_year" {{ request('period') == 'last_year' ? 'selected' : '' }}>Last Year</option>
        </select>
{{-- 
        <button type="submit"
            class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
            Filter
        </button> --}}

    </form>

    <!-- Stats -->
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">

        <div class="card-bg rounded-lg p-4">
            <p class="text-xs opacity-50">AFG Total</p>
            <h3 class="text-lg font-bold">
                {{ $savings->where('currency','AFG')->sum('amount') }}
            </h3>
        </div>

        <div class="card-bg rounded-lg p-4">
            <p class="text-xs opacity-50">USD Total</p>
            <h3 class="text-lg font-bold">
                {{ $savings->where('currency','USD')->sum('amount') }}
            </h3>
        </div>

        <div class="card-bg rounded-lg p-4">
            <p class="text-xs opacity-50">EUR Total</p>
            <h3 class="text-lg font-bold">
                {{ $savings->where('currency','EUR')->sum('amount') }}
            </h3>
        </div>

    </div>

    <!-- Saving List -->
    <div class="space-y-2">

        @forelse($savings as $saving)

            <div class="card-bg rounded-lg p-3 flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium">
                        From: {{ $saving->income->source ?? 'No Income' }} - {{ $saving->income->category ?? 'No Income' }}
                    </p>

                    <p class="text-xs opacity-50">
                        {{ $saving->date }}
                    </p>
                </div>

                <div class="flex items-center gap-2">

                    <span class="text-cyan-400 font-bold text-sm">
                        {{ $saving->amount }} {{ $saving->currency }}
                    </span>

                    <form method="POST"
                        action="{{ route('delete.saving', $saving->id) }}"
                        onsubmit="return confirmDelete(event)">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="p-1 opacity-50 hover:opacity-100">
                            <i data-lucide="trash-2" style="width:14px;height:14px"></i>
                        </button>
                    </form>

                </div>

            </div>

        @empty

            <div class="card-bg rounded-lg p-6 text-center opacity-50">
                No savings found.
            </div>

        @endforelse

    </div>

</section>

<!-- Add Saving Modal -->
<div id="modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="card-bg rounded-2xl p-5 w-full max-w-md max-h-[75vh] overflow-y-auto relative">

        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold">Add Saving</h3>
            <button type="button" onclick="closeModal()">✕</button>
        </div>

        <form method="POST" action="{{ route('store.savings') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 text-sm text-gray-300">Amount</label>
                <input type="number" name="amount" step="0.01"
                    class="w-full p-2 rounded-lg bg-white/5 border border-white/10 text-white"
                    placeholder="Amount" required>
            </div>

            <div>
                <label class="block mb-1 text-sm text-gray-300">Currency</label>
                <select name="currency"
                    class="w-full p-2 rounded-lg bg-white/5 border border-white/10 text-white" required>
                    <option value="AFG">AFG</option>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 text-sm text-gray-300">Date</label>
                <input type="date" name="date"
                    value="{{ date('Y-m-d') }}"
                    class="w-full p-2 rounded-lg bg-white/5 border border-white/10 text-white"
                    required>
            </div>

            <button type="submit"
                class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium">
                Save
            </button>

        </form>

    </div>

</div>

<script>
    function openModal() {
        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('modal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('modal').classList.remove('flex');
        document.getElementById('modal').classList.add('hidden');
    }

    document.getElementById('modal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });

    document.querySelectorAll('select[name="currency"], select[name="period"]').forEach((el) => {
        el.addEventListener('change', function () {
            const form = this.closest('form');
            if (form) {
                form.submit();
            }
        });
    });
</script>

@endsection