<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Saving;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    public function AllSavings(Request $request)
    {
        $query = Saving::with('income')->latest();

        // Currency Filter
        if ($request->filled('currency')) {
            $query->where('currency', $request->currency);
        }

        // Period Filter
        if ($request->period == 'daily') {
            $query->whereDate('date', today());
        }

        if ($request->period == 'monthly') {
            $query->whereMonth('date', now()->month)
                  ->whereYear('date', now()->year);
        }

        if ($request->period == 'last_month') {
            $lastMonth = now()->subMonth();

            $query->whereMonth('date', $lastMonth->month)
                  ->whereYear('date', $lastMonth->year);
        }

        if ($request->period == 'yearly') {
            $query->whereYear('date', now()->year);
        }

        if ($request->period == 'last_year') {
            $query->whereYear('date', now()->subYear()->year);
        }

        $savings = $query->get();

        return view('users.pages.saving.saving', compact('savings'));
    }

    public function StoreSavings(Request $request)
    {
        $request->validate([
            'income_id' => 'nullable|exists:incomes,id',
            'amount' => 'required|numeric|min:0',
            'currency' => 'required',
            'date' => 'required|date',
        ]);

        $income = null;

        if ($request->income_id) {
            $income = Income::find($request->income_id);
        }

        if ($income && $request->amount > $income->amount) {
            return back()->with('error', 'Amount is bigger than income!');
        }

        Saving::create([
            'income_id' => $request->income_id ?? null,
            'amount' => $request->amount,
            'currency' => $request->currency,
            'date' => $request->date,
        ]);

        if ($income) {
            $income->amount -= $request->amount;
            $income->save();
        }

        return back();
    }

    public function Deposit(Request $request)
    {
        $request->validate([
            'saving_id' => 'required',
            'add_amount' => 'required|numeric',
        ]);

        $saving = Saving::findOrFail($request->saving_id);

        $saving->saving = ($saving->saving ?? 0) + $request->add_amount;

        if ($saving->saving > $saving->amount) {
            $saving->saving = $saving->amount;
        }

        if ($saving->saving < 0) {
            $saving->saving = 0;
        }

        $saving->save();

        return back();
    }

    public function DeleteSaving($id)
    {
        Saving::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Saving deleted successfully.');
    }
}