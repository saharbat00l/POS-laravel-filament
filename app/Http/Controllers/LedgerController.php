<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LedgerController extends Controller
{
    public function ledgerView($customer_id)
    {
        $customer = Customer::with('sales')->findOrFail($customer_id)->toArray();

        // $customerArray = $customer->toArray();
        
        // $customerName = $customerArray['business_name'];
        // $customerAddress = $customerArray['address1'];
        // $customerContact = $customerArray['contact1'];
        // $customerEmail = $customerArray['business_email'];
        // $refferedBy = $customerArray['referred_by'];
        // $sales = $customerArray['sales'];
        // $salesArray = $sales->toArray();
        // $saleDate = $salesArray[0]['date'];
        // $salePrice = $salesArray[0]['sale_price'];
        // $productName = $salesArray[0]['sale_details']['product']['product_name'];
        // $productQuantity = $salesArray[0]['sale_details'][0]['quantity'];
        // $productScheme = $salesArray[0]['sale_details'][0]['scheme'];
        // $productPrice = $salesArray[0]['sale_details'][0]['sale_price'];
        // // dd($salesArray);

        // dd($customer);

        // 
        // $pdf = Pdf::loadView('pdf.ledger', compact('customer'));
        //     return $pdf->download('ledger.pdf');
        return view('pdf.ledger', compact('customer'));
    }
}
