@extends('users.admin_master')

@section('user')

<section id="view-income">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Budgets</h2>

        <button onclick="openModal()"
            class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium flex items-center gap-2">
            <i data-lucide="plus" style="width:16px;height:16px"></i>
            Add
        </button>
    </div>

    <div id="income-list" class="grid grid-cols-2 md:grid-cols-3 gap-3">

        @foreach($budgets as $budget)
            <div class="card-bg rounded-xl p-4 relative">

                <!-- Delete Button -->
                <form method="POST"
                    action="{{ route('delete.budgets', $budget->id) }}"
                    onsubmit="return confirmDelete(event)"
                    class="absolute top-2 right-2">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="p-1 opacity-50 hover:opacity-100">
                        <i data-lucide="trash-2" style="width:14px;height:14px"></i>
                    </button>
                </form>

                <p class="text-sm font-semibold">{{ $budget->name }}</p>

                <p class="text-xl font-bold text-indigo-400 mt-2">
                    {{ $budget->amount }} {{ $budget->currency }}
                </p>

                <p class="text-xs opacity-50 mt-2">
                    {{ $budget->date }}
                </p>

            </div>
        @endforeach

    </div>

</section>

<!-- Modal -->
<div id="modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="card-bg rounded-2xl p-5 w-full max-w-md max-h-[75vh] overflow-y-auto relative">

        <!-- Header -->
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold">Add Budgets</h3>
            <button onclick="closeModal()">✕</button>
        </div>

        <form method="POST" action="{{ route('store.budgets') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <label class="block mb-1 text-sm text-gray-300">Name</label>
                <input type="text" name="name"
                    class="w-full p-2 rounded-lg bg-white/5 border border-white/10 text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500" placeholder="Name"
                    required>
            </div>

            <!-- Amount -->
            <div>
                <label class="block mb-1 text-sm text-gray-300">Amount</label>
                <input type="number" name="amount" step="0.01"
                    class="w-full p-2 rounded-lg bg-white/5 border border-white/10 text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500" placeholder="Amount"
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

            <!-- Note -->
            <div>
                <label class="block mb-1 text-sm text-gray-300">Note</label>
                <textarea name="note" rows="2"
                    class="w-full p-2 rounded-lg bg-white/5 border border-white/10 text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500" placeholder="Note"></textarea>
            </div>

            <!-- Date -->
            <div>
                <label class="block mb-1 text-sm text-gray-300">Date</label>
                <input type="date" name="date"
                    value="{{ date('Y-m-d') }}"
                    class="w-full p-2 rounded-lg bg-white/5 border border-white/10 text-white focus:outline-none focus:border-indigo-500"
                    required>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition">
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