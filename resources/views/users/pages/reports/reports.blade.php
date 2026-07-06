@extends('users.admin_master')
@section('user')

<div class="card-bg rounded-xl p-5">

    <div class="mb-4">
        <select id="currency"
            class="w-48 p-2 rounded-lg bg-white/5 border border-white/10 text-white focus:outline-none focus:border-indigo-500">
            <option value="AFG" class="bg-gray-900">AFG</option>
            <option value="USD" class="bg-gray-900">USD</option>
            <option value="EUR" class="bg-gray-900">EUR</option>
        </select>
    </div>

    <canvas id="reportChart" height="120"></canvas>

</div>

<script>
const reportData = {
    AFG: [{{ $incomeAFG }}, {{ $expenseAFG }}, {{ $savingAFG }}],
    USD: [{{ $incomeUSD }}, {{ $expenseUSD }}, {{ $savingUSD }}],
    EUR: [{{ $incomeEUR }}, {{ $expenseEUR }}, {{ $savingEUR }}],
};

const ctx = document.getElementById('reportChart');

const chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Income', 'Expense', 'Saving'],
        datasets: [{
            label: 'Amount',
            data: reportData.AFG,

            backgroundColor: [
                '#22c55e', // Income (سبز)
                '#ef4444', // Expense (قرمز)
                '#3b82f6'  // Saving (آبی)
            ],

            borderColor: [
                '#16a34a',
                '#dc2626',
                '#2563eb'
            ],

            borderWidth: 1,
            borderRadius: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true
    }
});

document.getElementById('currency').addEventListener('change', function () {
    chart.data.datasets[0].data = reportData[this.value];
    chart.update();
});
</script>

@endsection