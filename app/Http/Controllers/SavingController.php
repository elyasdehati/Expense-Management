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
            'saving' => $request->saving,
            'currency' => $request->currency,
        ]);

        return redirect()->back();
    }

    public function Deposit(Request $request){
        $request->validate([
            'saving_id' => 'required',
            'add_amount' => 'required|numeric',
        ]);

        $saving = Saving::findOrFail($request->saving_id);

        $saving->saving = ($saving->saving ?? 0) + $request->add_amount;

        // نگذارد از هدف بیشتر شود
        if ($saving->saving > $saving->amount) {
            $saving->saving = $saving->amount;
        }

        // نگذارد منفی شود
        if ($saving->saving < 0) {
            $saving->saving = 0;
        }

        $saving->save();

        return back();
    }
}
