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
}
