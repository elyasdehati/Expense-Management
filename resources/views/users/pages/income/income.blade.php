@extends('users.admin_master')

@section('user')

<section id="view-income">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Income</h2>

        <button onclick="openIncomeModal()"
            class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium flex items-center gap-2">
            <i data-lucide="plus" style="width:16px;height:16px"></i>
            Add
        </button>
    </div>

    <!-- Income List -->
    <div id="income-list" class="space-y-2">

       @foreach($incomes as $income)
            <div class="card-bg rounded-lg p-3 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium">{{ $income->source }}</p>
                    <p class="text-xs opacity-50">
                        {{ $income->date }} · {{ $income->category }}
                    </p>
                </div>

                <div class="flex items-center gap-2">

                    <span class="text-emerald-400 font-bold text-sm">
                        +{{ $income->amount }} {{ $income->currency }}
                    </span>

                    <!-- Save Button -->
                    <button
                        type="button"
                        onclick="openSavingModal('{{ $income->id }}','{{ $income->amount }}','{{ $income->currency }}')"
                        class="p-1 opacity-50 hover:opacity-100"
                        title="Save">
                        <i data-lucide="piggy-bank" style="width:14px;height:14px"></i>
                    </button>

                    <!-- Delete Button -->
                    <form method="POST"
                        action="{{ route('income.delete', $income->id) }}"
                        onsubmit="return confirmDelete(event)">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="p-1 opacity-50 hover:opacity-100">
                            <i data-lucide="trash-2" style="width:14px;height:14px"></i>
                        </button>
                    </form>

                </div>
            </div>
        @endforeach

    </div>

</section>

<!-- Income Modal -->
<div id="incomeModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="card-bg rounded-2xl p-5 w-full max-w-md max-h-[75vh] overflow-y-auto relative">

        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold">Add Income</h3>
            <button onclick="closeIncomeModal()">✕</button>
        </div>

        <form method="POST" action="{{ route('income.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 text-sm text-gray-300">Amount</label>
                <input type="number" name="amount" step="0.01"
                    class="w-full p-2 rounded-lg bg-white/5 border border-white/10 text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500"
                    required>
            </div>

            <div>
                <label class="block mb-1 text-sm text-gray-300">Currency</label>
                <select name="currency"
                    class="w-full p-2 rounded-lg bg-white/5 border border-white/10 text-white focus:outline-none focus:border-indigo-500"
                    required>
                    <option value="AFG" class="bg-gray-900">AFG</option>
                    <option value="USD" class="bg-gray-900">USD</option>
                    <option value="EUR" class="bg-gray-900">EUR</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 text-sm text-gray-300">Category</label>
                <select name="category"
                    class="w-full p-2 rounded-lg bg-white/5 border border-white/10 text-white focus:outline-none focus:border-indigo-500"
                    required>
                    <option value="Salary" class="bg-gray-900">Salary</option>
                    <option value="Freelancing" class="bg-gray-900">Freelancing</option>
                    <option value="Business" class="bg-gray-900">Business</option>
                    <option value="Investments" class="bg-gray-900">Investments</option>
                    <option value="Gifts" class="bg-gray-900">Gifts</option>
                    <option value="Bounuses" class="bg-gray-900">Bounuses</option>
                    <option value="Others" class="bg-gray-900">Others</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 text-sm text-gray-300">Source</label>
                <input type="text" name="source"
                    class="w-full p-2 rounded-lg bg-white/5 border border-white/10 text-white"
                    required>
            </div>

            <div>
                <label class="block mb-1 text-sm text-gray-300">Note</label>
                <textarea name="note" rows="2"
                    class="w-full p-2 rounded-lg bg-white/5 border border-white/10 text-white"></textarea>
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

<!-- Saving Modal -->
<div id="savingModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="card-bg rounded-2xl p-5 w-full max-w-md max-h-[75vh] overflow-y-auto relative">

        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold">Add Saving</h3>
            <button onclick="closeSavingModal()">✕</button>
        </div>

        <form method="POST" action="{{ route('store.savings') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 text-sm text-gray-300">Income Amount</label>
                <input type="text" id="incomePreview"
                    class="w-full p-2 rounded-lg bg-white/10 border border-white/10 text-gray-300"
                    readonly>
            </div>

            <div>
                <label class="block mb-1 text-sm text-gray-300">Amount</label>
                <input type="number" id="savingAmount" name="amount" step="0.01"
                    class="w-full p-2 rounded-lg bg-white/5 border border-white/10 text-white"
                    required>

                <input type="hidden" id="savingIncomeId" name="income_id">

                <!-- ✅ NEW: hidden currency for fix -->
                <input type="hidden" id="savingCurrencyHidden" name="currency">
            </div>

            <div>
                <label class="block mb-1 text-sm text-gray-300">Currency</label>
                <select id="savingCurrency"
                    class="w-full p-2 rounded-lg bg-white/5 border border-white/10 text-white">
                    <option value="AFG" class="bg-gray-900">AFG</option>
                    <option value="USD" class="bg-gray-900">USD</option>
                    <option value="EUR" class="bg-gray-900">EUR</option>
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

<!-- Scripts -->
<script>
    function openIncomeModal() {
        document.getElementById('incomeModal').classList.remove('hidden');
        document.getElementById('incomeModal').classList.add('flex');
    }

    function closeIncomeModal() {
        document.getElementById('incomeModal').classList.remove('flex');
        document.getElementById('incomeModal').classList.add('hidden');
    }

    document.getElementById('incomeModal').addEventListener('click', function(e) {
        if (e.target === this) closeIncomeModal();
    });

    function openSavingModal(incomeId, amount, currency) {

        document.getElementById('savingIncomeId').value = incomeId;
        document.getElementById('incomePreview').value = amount;

        const savingCurrency = document.getElementById('savingCurrency');
        const hiddenCurrency = document.getElementById('savingCurrencyHidden');

        savingCurrency.value = currency;
        hiddenCurrency.value = currency;

        const modal = document.getElementById('savingModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeSavingModal() {
        const modal = document.getElementById('savingModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }

    document.getElementById('savingModal').addEventListener('click', function(e) {
        if (e.target === this) closeSavingModal();
    });
</script>

@endsection