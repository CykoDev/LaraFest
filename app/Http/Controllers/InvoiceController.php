<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use App\Expense;

class InvoiceController extends Controller
{
    public function generatepdf()
    {
        $user = Auth::user();
        $expenses = Expense::where('user_id', $user->id)->get();
        $total = 0;
        foreach ($expenses as $expense) $total += $expense->price;
        $pdf = PDF::loadView('pdf.invoice', ['expenses' => $expenses, 'total' => $total])->setPaper('A4', 'landscape');
        return $pdf->download('testfile.pdf');
    }
}
