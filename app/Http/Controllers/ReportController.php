<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
use App\Models\Saving;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function AllReports(){
        // AFG
        $incomeAFG = Income::where('currency', 'AFG')->sum('amount');
        $expenseAFG = Expense::where('currency', 'AFG')->sum('amount');
        $savingAFG = Saving::where('currency', 'AFG')->sum('amount');

        // USD
        $incomeUSD = Income::where('currency', 'USD')->sum('amount');
        $expenseUSD = Expense::where('currency', 'USD')->sum('amount');
        $savingUSD = Saving::where('currency', 'USD')->sum('amount');

        // EUR
        $incomeEUR = Income::where('currency', 'EUR')->sum('amount');
        $expenseEUR = Expense::where('currency', 'EUR')->sum('amount');
        $savingEUR = Saving::where('currency', 'EUR')->sum('amount');

        return view('users.pages.reports.reports', compact(
            'incomeAFG',
            'expenseAFG',
            'savingAFG',

            'incomeUSD',
            'expenseUSD',
            'savingUSD',

            'incomeEUR',
            'expenseEUR',
            'savingEUR'
        ));
    }
}
