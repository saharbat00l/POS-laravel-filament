<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorLedgerController extends Controller
{
    public function ledgerPDF($id)
    {
        $vendor = Vendor::with('purchases')->findOrFail($id)->toArray();
        // $vendor = Vendor::with('purchases')->findOrFail($id)->toArray();

    
        // $pdf = Pdf::loadView('pdf.ledger', compact('customer'));
        //     return $pdf->download('ledger.pdf');
        return view('pdf.vendor-ledger', compact('vendor'));
    }
}
