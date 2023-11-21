<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .invoice {
            max-width: 600px;
            margin: auto;
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
		.total-row {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="invoice">
		<h1>Filament POS Invoice</h1>
        <h2>Invoice Number #{{$salesdata->id}}</h2>
        <p>Date: {{$salesdata->date}}</p>

        <h3>Customer Details:</h3>
        <p>Customer's Name: {{$salesdata->customer->business_name}}</p>
        <p>Email: {{$salesdata->customer->business_email}}</p>
        <p>Address: {{$salesdata->customer->address1}}</p>
        <p>Contact Number: {{$salesdata->customer->contact1}}</p>

        @if(!empty($salesdata) && !empty($salesdata->saleDetails))
            <h3>Products:</h3>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Total Quantity</th>
                        <th>Scheme</th>
                        <th>Sale Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($salesdata->saleDetails as $value)
                        <tr>
                            <td>{{$value->product->product_name}}</td>
                            <td>{{$value->quantity}}</td>
                            <td>{{$value->scheme}}</td>
                            <td>{{$value->sale_price}}</td>
                        </tr>
                    @endforeach
					<tr class="total-row">
                        <td colspan="3">Total Amount</td>
                        <td>
                            {{$salesdata->saleDetails->sum('sale_price')}}
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
