<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function AllExpense(){
        $expense = Expense::latest()->get();
        return view('users.pages.expense.expense', compact('expense'));
    }
}
