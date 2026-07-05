<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;

class BudgetsController extends Controller
{
    public function AllBudgets(){
        $budgets = Budget::latest()->get();
        return view('users.pages.budgets.budgets', compact('budgets'));
    }

    public function StoreBudgets(Request $request){
        Budget::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'currency' => $request->currency,
            'note' => $request->note,
            'date' => $request->date,
        ]);

        return redirect()->back();
    }
}
