<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Expense;
use App\Invoice;

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

    public function paymentStatus()
    {
        return view('expenses.payment-status');
    }

    public function generateInvoice()
    {
    }
}
