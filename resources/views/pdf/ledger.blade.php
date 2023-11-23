<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    <style>
        /* CSS styles for the page */
        .ledger {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .ledger h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .ledger h2, .ledger h3 {
            margin-bottom: 10px;
        }

        .ledger p {
            margin: 5px 0;
        }

        .ledger table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .ledger th, .ledger td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
    </style>

    <div class="ledger">
        <h1>Filament POS Ledger</h1>
        <p>Date: {{ $customer['created_at'] }}</p>

        <h3>Customer Details:</h3>
        <p>Customer's Name: {{$customer['business_name'] }}</p>
        <p>Email: {{$customer['business_email'] }}</p>
        <p>Address: {{$customer['address1'] }}</p>
        <p>Contact Number: {{$customer['contact1'] }}</p>

        <h3>Sales Details:</h3>
        @if(!empty($customer['sales']))
        <table>
            <thead>
                <tr>
                    <th>Sale Number</th>
                    <th>Date</th>
                    <th>Details</th>
                    <th>Sale Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customer['sales'] as $key => $sale)
                @if(!empty($sale['sale_details']))
                    @foreach($sale['sale_details'] as $index => $sale_detail)
                    <tr>
                        <td>{{ $sale['id'] }}</td>
                        <td>{{ $sale['date'] }}</td>
                        <td>{{ $sale_detail['product']['product_name'] }}</td>
                        <td>{{ $sale_detail['sale_price'] }}</td>
                    </tr>
                    @endforeach
                @endif
                @endforeach
                <tr>
                    <td colspan="3" style="text-align: right;"><strong>Total:</strong></td>
                    <td>
                        @php
                            $total = 0;
                            foreach($customer['sales'] as $key => $sale) {
                                if(!empty($sale['sale_details'])) {
                                    foreach($sale['sale_details'] as $index => $sale_detail) {
                                        $total += $sale_detail['sale_price'];
                                    }
                                }
                            }
                            echo $total;
                        @endphp
                    </td>
                </tr>
            </tbody>
        </table>
        @endif
    </div>
    
</body>
</html>