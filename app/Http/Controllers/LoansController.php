<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoansController extends Controller
{
    public function AllLons(){
        $loan = Loan::latest()->get();
        return view('users.pages.loans.loans', compact('loan'));
    }

    public function StoreLoans(Request $request){
        Loan::create([
            'type' => $request->type,
            'person_name' => $request->person_name,
            'phone' => $request->phone,
            'amount' => $request->amount,
            'currency' => $request->currency,
            'notes' => $request->notes,
            'due_date' => $request->due_date,
            'date' => $request->date,
        ]);

        return redirect()->back()->with('success', 'Saved Successfully');
    }
}
