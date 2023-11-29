<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CustomerLedgerController extends Controller
{
    public function ledgerPDF($id)
    {
        $customer = Customer::with('sales')->findOrFail($id)->toArray();
        // $vendor = Vendor::with('purchases')->findOrFail($id)->toArray();

    
        // dd($customer);
        
        // $pdf = Pdf::loadView('pdf.ledger', compact('customer'));
        //     return $pdf->download('ledger.pdf');
        return view('pdf.ledger', compact('customer'));
    }
}
