@extends('users.admin_master')

@section('user')

<section id="view-income">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Loans & Debts</h2>

        <button onclick="openModal()"
            class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium flex items-center gap-2">
            <i data-lucide="plus" style="width:16px;height:16px"></i>
            Add
        </button>
    </div>

    <!-- Income List -->
    <div id="income-list" class="space-y-2">
        @foreach($loan as $item)
            <div class="card-bg rounded-lg p-3 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium">{{ $item->category }}</p>
                    <p class="text-xs opacity-50">
                        {{ $item->date }}
                    </p>
                </div>

                <div class="flex items-center gap-2">
                    <span class="text-red-400 font-bold text-sm">
                        -{{ $item->amount }} {{ $item->currency }}
                    </span>

                    <form method="POST" action="{{ route('expense.delete', $item->id) }}" onsubmit="return confirmDelete(event)">
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

<!-- Modal -->
<div id="modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="card-bg rounded-2xl p-5 w-full max-w-md max-h-[75vh] overflow-y-auto relative">

        <!-- Header -->
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold">Add - Loans & Debts   </h3>
            <button onclick="closeModal()">✕</button>
        </div>

        <form method="POST" action="" class="space-y-3">
            @csrf

            <!-- Loan / Debt -->
            <div class="flex gap-2 mb-2">
                <label class="flex-1">
                    <input type="radio" name="type" value="Loan" checked> I Borrowed
                </label>
                <label class="flex-1">
                    <input type="radio" name="type" value="Debt"> I Debt
                </label>
            </div>

            <!-- Person Name -->
            <div>
                <label class="block mb-1 text-xs opacity-60">Person Name</label>
                <input type="text" name="person_name"
                    class="w-full p-2.5 rounded-lg bg-white/5 border border-white/10 text-sm"
                    placeholder="Person Name" required>
            </div>

            <!-- Phone -->
            <div>
                <label class="block mb-1 text-xs opacity-60">Phone</label>
                <input type="tel" name="phone"
                    class="w-full p-2.5 rounded-lg bg-white/5 border border-white/10 text-sm"
                    placeholder="Phone">
            </div>

            <!-- Amount -->
            <div>
                <label class="block mb-1 text-xs opacity-60">Amount</label>
                <input type="number" name="amount" step="0.01" min="0"
                    class="w-full p-2.5 rounded-lg bg-white/5 border border-white/10 text-sm"
                    placeholder="Amount" required>
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

            <!-- Notes -->
            <div>
                <label class="block mb-1 text-xs opacity-60">Notes</label>
                <textarea name="notes" rows="2"
                    class="w-full p-2.5 rounded-lg bg-white/5 border border-white/10 text-sm"
                    placeholder="Notes"></textarea>
            </div>

            <!-- Due Date -->
            <div>
                <label class="block mb-1 text-xs opacity-60">Due Date</label>
                <input type="date" name="due_date"
                    value="{{ date('Y-m-d') }}"
                    class="w-full p-2.5 rounded-lg bg-white/5 border border-white/10 text-sm">
            </div>

            <!-- Date -->
            <div>
                <label class="block mb-1 text-xs opacity-60">Date</label>
                <input type="date" name="date"
                    value="{{ date('Y-m-d') }}"
                    class="w-full p-2.5 rounded-lg bg-white/5 border border-white/10 text-sm"
                    required>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium text-sm">
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
</script>

@endsection