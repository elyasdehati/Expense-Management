<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ProfileController;
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

    Route::controller(IncomeController::class)->group(function () {
        Route::get('/all/income', 'AllIncome')->name('all.income');
        Route::post('/income/store', 'StoreIncome')->name('income.store');
        Route::delete('/income/delete/{id}', 'DeleteIncome')->name('income.delete');
    });

    Route::controller(ExpenseController::class)->group(function () {
        Route::get('/all/expense', 'AllExpense')->name('all.expense');
        Route::post('/store/expense', 'StoreExpense')->name('store.expense');
        Route::delete('/expense/delete/{id}', 'DeleteExpense')->name('expense.delete');
    });

});

require __DIR__.'/auth.php';
