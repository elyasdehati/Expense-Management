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

    public function StoreExpense(Request $request){
        $request->validate([
            'amount' => 'required',
            'currency' => 'required',
            'category' => 'required',
            'date' => 'required',
        ]);

        Expense::create([
            'amount' => $request->amount,
            'currency' => $request->currency,
            'category' => $request->category,
            'note' => $request->note,
            'date' => $request->date,
        ]);

        return redirect()->back();
    }

    public function DeleteExpense($id){
        Expense::findOrFail($id)->delete();
        return back();
    }
}
