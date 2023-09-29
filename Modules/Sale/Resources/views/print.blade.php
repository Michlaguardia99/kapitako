<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sale Details</title>
    <style>
        body {
    font-family: 'Ubuntu', sans-serif;
    font-size: 12px;
    line-height: 18px;
    margin: 0 auto;
    max-width: 800px;
    background-color: #f4f4f4; /* Background color */
    background-image: url('path/to/your/image.jpg'); /* Background image */
    background-repeat: no-repeat; /* Prevent image from repeating */
    background-size: cover; /* Cover the entire body with the background image */
    background-position: center center; /* Center the background image */
}
        * {
            font-size: 12px;
            line-height: 18px;
            font-family: 'Ubuntu', sans-serif;
        }
        h2 {
            font-size: 16px;
        }
        td,
        th,
        tr,
        table {
            border-collapse: collapse;
        }
        tr {border-bottom: 1px dashed #ddd;}
        td,th {padding: 7px 0;width: 50%;}

        table {width: 100%;}
        tfoot tr th:first-child {text-align: left;}

        .centered {
            text-align: center;
            align-content: center;
        }
        small{font-size:11px;}

        @media print {
            * {
                font-size:12px;
                line-height: 20px;
            }
            td,th {padding: 5px 0;}
            .hidden-print {
                display: none !important;
            }
            tbody::after {
                content: '';
                display: block;
                page-break-after: always;
                page-break-inside: auto;
                page-break-before: avoid;
            }
        }
    </style>
    <!-- <link rel="stylesheet" href="{{ public_path('b3/bootstrap.min.css') }}"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
</head>
<body>
<div class="container-fluid">
    <button id="generatePdfButton">Generate PDF </button>
    <div class="row" id="contentToConvert">
        <div class="col-xs-12">
            <div style="text-align: center;margin-bottom: 25px;">
                <img width="180" src="{{ asset('images/logo-dark.png') }}" alt="Logo">
                <h4 style="margin-bottom: 20px;">
                    <span>Reference::</span> <strong>{{ $sale->reference }}</strong>
                </h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-xs-4 mb-3 mb-md-0">
                            <h4 class="mb-2" style="border-bottom: 1px solid #dddddd;padding-bottom: 10px;">Company Info:</h4>
                            <div><strong>{{ settings()->company_name }}</strong></div>
                            <div>{{ settings()->company_address }}</div>
                            <div>Email: {{ settings()->company_email }}</div>
                            <div>Phone: {{ settings()->company_phone }}</div>
                        </div>

                        <div class="col-xs-4 mb-3 mb-md-0">
                            <h4 class="mb-2" style="border-bottom: 1px solid #dddddd;padding-bottom: 10px;">Customer Info:</h4>
                            <div><strong>{{ $customer->customer_name }}</strong></div>
                            <div>{{ $customer->address }}</div>
                            <div>Email: {{ $customer->customer_email }}</div>
                            <div>Phone: {{ $customer->customer_phone }}</div>
                        </div>

                        <div class="col-xs-4 mb-3 mb-md-0">
                            <h4 class="mb-2" style="border-bottom: 1px solid #dddddd;padding-bottom: 10px;">Invoice Info:</h4>
                            <div>Invoice: <strong>INV/{{ $sale->reference }}</strong></div>
                            <div>Date: {{ \Carbon\Carbon::parse($sale->date)->format('d M, Y') }}</div>
                            <div>
                                Status: <strong>{{ $sale->status }}</strong>
                            </div>
                            <div>
                                Payment Status: <strong>{{ $sale->payment_status }}</strong>
                            </div>
                        </div>

                    </div>

                    <div class="table-responsive-sm" style="margin-top: 30px;">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="align-middle">Product</th>
                                <th class="align-middle">Net Unit Price</th>
                                <th class="align-middle">Quantity</th>
                                <th class="align-middle">Discount</th>
                                <th class="align-middle">Tax</th>
                                <th class="align-middle">Sub Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sale->saleDetails as $item)
                                <tr>
                                    <td class="align-middle">
                                        {{ $item->product_name }} <br>
                                        <span class="badge badge-success">
                                                {{ $item->product_code }}
                                            </span>
                                    </td>

                                    <td class="align-middle">{{ format_currency($item->unit_price) }}</td>

                                    <td class="align-middle">
                                        {{ $item->quantity }}
                                    </td>

                                    <td class="align-middle">
                                        {{ format_currency($item->product_discount_amount) }}
                                    </td>

                                    <td class="align-middle">
                                        {{ format_currency($item->product_tax_amount) }}
                                    </td>

                                    <td class="align-middle">
                                        {{ format_currency($item->sub_total) }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-xs-offset-8">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td class="left"><strong>Discount ({{ $sale->discount_percentage }}%)</strong></td>
                                    <td class="right">{{ format_currency($sale->discount_amount) }}</td>
                                </tr>
                                <tr>
                                    <td class="left"><strong>Tax ({{ $sale->tax_percentage }}%)</strong></td>
                                    <td class="right">{{ format_currency($sale->tax_amount) }}</td>
                                </tr>
                                <tr>
                                    <td class="left"><strong>Shipping</strong></td>
                                    <td class="right">{{ format_currency($sale->shipping_amount) }}</td>
                                </tr>
                                <tr>
                                    <td class="left"><strong>Grand Total</strong></td>
                                    <td class="right"><strong>{{ format_currency($sale->total_amount) }}</strong></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 25px;">
                        <div class="col-xs-12">
                            <p style="font-style: italic;text-align: center">{{ settings()->company_name }} &copy; {{ date('Y') }}.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->
<script>
    const generatePdfButton = document.getElementById('generatePdfButton');

    generatePdfButton.addEventListener('click', () => {
        const element = document.getElementById('contentToConvert'); // Replace with the ID of the HTML content you want to convert to PDF
        const opt = {
            margin:       [10, 10, 10, 10], // Add default margins (top, right, bottom, left) in millimeters
            filename:     'sales.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 1 },
            jsPDF: {
                unit: 'mm', // Change to millimeters for a more standard unit in invoicing
                format: [210, 297], // Use A4 format (210mm width, 297mm height)
                orientation: 'portrait' // Keep in portrait mode for most invoices
            }
        };

        // Generate PDF
        html2pdf().from(element).set(opt).save();
    });
</script>

</body>
</html>