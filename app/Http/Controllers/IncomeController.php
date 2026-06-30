<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function AllIncome(){
        $incomes = Income::latest()->get();
        return view('users.pages.income.income', compact('incomes'));
    }

    public function StoreIncome(Request $request){
        $request->validate([
            'amount' => 'required',
            'currency' => 'required',
            'category' => 'required',
            'source' => 'required',
            'date' => 'required',
        ]);

        Income::create([
            'amount' => $request->amount,
            'currency' => $request->currency,
            'category' => $request->category,
            'source' => $request->source,
            'note' => $request->note,
            'date' => $request->date,
        ]);

        return redirect()->back();
    }

    public function DeleteIncome($id){
        Income::findOrFail($id)->delete();
        return back();
    }
}
