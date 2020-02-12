<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{
    public function generatepdf(){

        $pdf = PDF::loadView('pdf.invoice');
        return $pdf->download('testfile.pdf');
    }
}
