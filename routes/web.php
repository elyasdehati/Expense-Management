<?php

use App\Http\Controllers\BudgetsController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SavingController;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    $currencies = ['AFG', 'USD', 'EUR'];
    $balances = [];
    foreach ($currencies as $currency) {
        $income = Income::where('currency', $currency)->sum('amount');
        $expense = Expense::where('currency', $currency)->sum('amount');
        $balances[$currency] = $income - $expense;
    }
    // Last 7 Days Chart Data
    $chartDates = [];
    $incomeChart = [];
    $expenseChart = [];
    $currentDate = \Carbon\Carbon::now()->subDays(6);
    $endDate = \Carbon\Carbon::now();
    while ($currentDate <= $endDate) {
        $date = $currentDate->format('Y-m-d');

        // show date like: 1 Jun
        $chartDates[] = $currentDate->format('j M');
        $dailyIncome = Income::where('date', $date)->sum('amount');
        $dailyExpense = Expense::where('date', $date)->sum('amount');
        $incomeChart[] = $dailyIncome;
        $expenseChart[] = -$dailyExpense;
        $currentDate->addDay();
    }
    return view('users.index', compact(
        'balances',
        'chartDates',
        'incomeChart',
        'expenseChart'
    ));

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');

    //Income
    Route::controller(IncomeController::class)->group(function () {
        Route::get('/all/income', 'AllIncome')->name('all.income');
        Route::post('/income/store', 'StoreIncome')->name('income.store');
        Route::delete('/income/delete/{id}', 'DeleteIncome')->name('income.delete');
    });

    // Expense
    Route::controller(ExpenseController::class)->group(function () {
        Route::get('/all/expense', 'AllExpense')->name('all.expense');
        Route::post('/store/expense', 'StoreExpense')->name('store.expense');
        Route::delete('/expense/delete/{id}', 'DeleteExpense')->name('expense.delete');
    });

    // Saving
    Route::controller(SavingController::class)->group(function () {
        Route::get('/all/savings', 'AllSavings')->name('all.savings');
        Route::post('/store/savings', 'StoreSavings')->name('store.savings');
        Route::post('/deposit/savings', 'Deposit')->name('deposit.savings');
        Route::delete('/delete/saving/{id}', 'DeleteSaving')->name('delete.saving');
        Route::post('/saving/withdraw', 'Withdraw')->name('withdraw.saving');
    });

    // Loans
    Route::controller(LoansController::class)->group(function () {
        Route::get('/all/loans', 'AllLons')->name('all.loans');
        Route::post('/store/loans', 'StoreLoans')->name('store.loans');
        Route::delete('/delete/loans/{id}', 'DeleteLoans')->name('delete.loans');
    });

    // Budgets
    Route::controller(BudgetsController::class)->group(function () {
        Route::get('/all/budgets', 'AllBudgets')->name('all.budgets');
        Route::post('/store/budgets', 'StoreBudgets')->name('store.budgets');
        Route::delete('/delete/budgets/{id}', 'DeleteBudgets')->name('delete.budgets');
    });

    // Reports
    Route::controller(ReportController::class)->group(function () {
        Route::get('/all/reports', 'AllReports')->name('all.reports');
    });

});

require __DIR__.'/auth.php';
