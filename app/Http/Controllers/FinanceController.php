<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Expense;
use App\Photo;
use App\User;
use \PDF;

class FinanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('applicant')->except('verifyUsersPayment', 'unverifyUserPayment', 'verifyUserPayment');
        $this->middleware('moderator')->only('verifyUsersPayment', 'unverifyUserPayment', 'verifyUserPayment');
    }

    public function enrolledEvents()
    {
        return view('expenses.enrolled-events');
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
        return view('expenses.payment-status');
    }

    public function uploadProof(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();

        if ($file = $request->file('invoice_proof_id')) {

            $name = time() . $file->getClientOriginalName();
            $file->move('img/' . $user->imageFolder . 'proofs/', $name);
            $photo = Photo::create([
                'path' => $user->imageFolder . 'proofs/' . $name,
                'type' => 'user_invoice_proof',
                'uploaded_by_user_id' => $user->id,
            ]);
            $input['invoice_proof_id'] = $photo->id;

            if ($user->invoiceProof) {
                unlink(public_path() . $user->invoiceProof->path);
                Photo::findOrFail($user->invoiceProof->id)->delete();
            }
        }

        $user->update($input);
        return redirect()->back();
    }

    public function verifyUsersPayment(Request $request)
    {
        if (!empty($request->checkBoxArray)) {
            $users = User::findOrFail($request->users);
            foreach ($users as $user) {

                $user->update([
                    'payment_status' => 'paid',
                ]);
            }
        }
        return redirect()->back();
    }

    public function verifyUserPayment($id)
    {
        User::findOrFail($id)->update([
            'payment_status' => 'paid',
        ]);
        return redirect()->back();
    }

    public function unverifyUserPayment($id)
    {
        User::findOrFail($id)->update([
            'payment_status' => 'unverified',
        ]);
        return redirect()->back();
    }
}
