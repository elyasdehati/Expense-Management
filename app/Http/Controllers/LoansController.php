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
}
