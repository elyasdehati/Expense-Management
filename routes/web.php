<?php

use App\Http\Controllers\BudgetsController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SavingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('users.index');
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

});

require __DIR__.'/auth.php';
