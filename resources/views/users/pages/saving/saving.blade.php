@extends('users.admin_master')

@section('user')

<section id="view-income">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Savings</h2>

        <button onclick="openModal()"
            class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium flex items-center gap-2">
            <i data-lucide="plus" style="width:16px;height:16px"></i>
            Add
        </button>
    </div>

    <!-- Income List -->
    <div id="income-list" class="space-y-2">

        @foreach($savings as $saving)
            <div class="card-bg rounded-xl p-4">

                <div class="flex justify-between items-center mb-2">
                    <p class="font-semibold text-sm">{{ $saving->name }}</p>

                    <span class="text-xs opacity-60">
                        {{ $saving->saving ?? 0 }} / {{ $saving->amount }} {{ $saving->currency }}
                    </span>
                </div>

                @php
                    $percent = $saving->amount > 0 ? (($saving->saving ?? 0) / $saving->amount) * 100 : 0;
                @endphp

                <div class="w-full h-2 rounded-full bg-white/10 overflow-hidden">
                    <div class="progress-bar h-full rounded-full bg-gradient-to-r from-indigo-500 to-purple-500"
                        style="width:{{ $percent }}%"></div>
                </div>

                <div class="flex justify-between mt-2">
                    <span class="text-xs opacity-50">{{ round($percent) }}%</span>

                    <button onclick="openDepositModal({{ $saving->id }}, {{ $saving->amount ?? 0 }}, {{ $saving->saving ?? 0 }})"
                            class="text-xs text-indigo-400">
                        Deposit
                    </button>
                </div>

            </div>
        @endforeach

    </div>

</section>

<!-- Modal -->
<div id="modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="card-bg rounded-2xl p-5 w-full max-w-md max-h-[75vh] overflow-y-auto relative">

        <!-- Header -->
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold">Add Saving</h3>
            <button onclick="closeModal()">✕</button>
        </div>

        <form method="POST" action="{{ route('store.savings') }}" class="space-y-4">
            @csrf

            <!-- Goal-Name -->
            <div>
                <label class="block mb-1 text-sm text-gray-300">Goal Name</label>
                <input type="text" name="name"
                    class="w-full p-2 rounded-lg bg-white/5 border border-white/10 text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500" placeholder="Goal Name"
                    required>
            </div>

            <!-- Target-Amount -->
            <div>
                <label class="block mb-1 text-sm text-gray-300">Target Amount</label>
                <input type="number" name="amount" step="0.01"
                    class="w-full p-2 rounded-lg bg-white/5 border border-white/10 text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500" placeholder="Target Amount"
                    required>
            </div>

            <!-- Currency -->
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

            <!-- Submit -->
            <button type="submit"
                class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition">
                Save
            </button>
        </form>

    </div>
</div>

<div id="deposit-modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="card-bg rounded-2xl p-5 w-full max-w-md">

        <div class="flex justify-between mb-4">
            <h3 class="text-lg font-bold">Deposit</h3>
            <button onclick="closeDepositModal()">✕</button>
        </div>

        <form method="POST" action="{{ route('deposit.savings') }}">
            @csrf

            <input type="hidden" name="saving_id" id="saving_id">

            <!-- Target -->
            <div>
                <label class="text-sm text-gray-300">Target Amount</label>
                <input type="number" id="target_amount" class="w-full p-2 bg-white/5 rounded-lg" readonly>
            </div>

            <!-- Current -->
            <div class="mt-3">
                <label class="text-sm text-gray-300">Current Saving</label>
                <input type="number" id="current_amount" class="w-full p-2 bg-white/5 rounded-lg" readonly>
            </div>

            <!-- Add -->
            <div class="mt-3">
                <label class="text-sm text-gray-300">Add Amount</label>
                <input type="number" name="add_amount" class="w-full p-2 bg-white/5 rounded-lg" required>
            </div>

            <button class="w-full mt-4 bg-indigo-600 py-2 rounded-lg text-white">
                Save
            </button>
        </form>

    </div>
</div>

<!-- Scripts -->
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

function openDepositModal(id, target, current) {
    document.getElementById('deposit-modal').classList.remove('hidden');
    document.getElementById('deposit-modal').classList.add('flex');

    document.getElementById('saving_id').value = id;
    document.getElementById('target_amount').value = target;
    document.getElementById('current_amount').value = current;
}

function closeDepositModal() {
    document.getElementById('deposit-modal').classList.add('hidden');
    document.getElementById('deposit-modal').classList.remove('flex');
}
</script>

@endsection