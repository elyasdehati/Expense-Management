<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    public function AllSavings(){
        $savings = Saving::latest()->get();
        return view('users.pages.saving.saving', compact('savings'));
    }

    public function StoreSavings(Request $request){
        $request->validate([
            'name' => 'required',
            'amount' => 'required',
            'currency' => 'required',
        ]);

        Saving::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'currency' => $request->currency,
        ]);

        return redirect()->back();
    }
}
