<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Expense;
use \PDF;
class FinanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('applicant');
    }

    public function enrolledEvents()
    {
        $user = Auth::user();
        $packageEvents = $user->package->events($user->id);
        $events = $user->events;
        return view('expenses.enrolled-events', compact('packageEvents', 'events'));
    }

    public function expensesSummary()
    {
        $expenses = Auth::user()->expenses;
        return view('expenses.summary', compact('expenses'));
    }

    public function generateInvoice()
    {
        $user = Auth::user();
        $expenses = Expense::where('user_id', $user->id)->get();
        $total = 0;
        foreach ($expenses as $expense) $total += $expense->price;
        $pdf = PDF::loadView('pdf.invoice', ['expenses' => $expenses, 'total' => $total])->setPaper('A4', 'landscape');
        return $pdf->download('testfile.pdf');
    }

    public function paymentStatus()
    {
        $user = Auth::user();
        return view('expenses.payment-status', compact('user'));
    }
}
