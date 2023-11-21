<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    //

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfview(Request $request, $saleID)
    {
        // $url = route('get-pdf', ['saleID' => $saleID]);

        // $items = DB::table("items")->get();
        // view()->share('items',$items);

        // $saleID = $saleID->id;
        // $id = Sale::find($saleID);
        $salesdata = Sale::find($saleID);
        // dd($salesdata->toArray(), $saleID);
//         $customer = Sale::with('customer')->find($saleID);

//         $customerArray = $customer->toArray();
//         $salesDataArray = $salesdata->toArray();

//         // Assuming $customerArray is the array you obtained

//         $customerId = $customerArray[0]['customer']['id'];
//         $customerName = $customerArray[0]['customer']['business_name'];
//         $customerAddress = $customerArray[0]['customer']['address1'];
//         $customerContact = $customerArray[0]['customer']['contact1'];
//         $customerEmail = $customerArray[0]['customer']['business_email'];
//         $refferedBy = $customerArray[0]['customer']['referred_by'];


// // Assuming $salesDataArray is the array containing sales data

//         $saleDate = $salesDataArray[0]['date'];
//         $salePrice = $salesDataArray[0]['sale_price'];
//         $productName = $salesDataArray[0]['sale_details']['product']['product_name'];
//         $productQuantity = $salesDataArray[0]['sale_details'][0]['quantity'];
//         $productScheme = $salesDataArray[0]['sale_details'][0]['scheme'];
//         $productPrice = $salesDataArray[0]['sale_details'][0]['sale_price'];
        // dd($salesDataArray);
        // dd($salesdata);

        // if($request->has('download')){
            $pdf = Pdf::loadView('pdf.invoice-pdf', compact('salesdata'));
            return $pdf->download('pdfview.pdf');
        // }


        return view('pdf.invoice-pdf', compact('salesdata'));
    }
}
