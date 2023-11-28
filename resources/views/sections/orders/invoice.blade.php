<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>A simple, clean, and responsive HTML invoice template</title>

    <!-- Favicon -->
    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />

    <!-- Invoice styling -->
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
            color: #777;
        }

        body h1 {
            font-weight: 300;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        body h3 {
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        body a {
            color: #06f;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:last-child() {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.total td:nth-child(3) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="5">
                    <table>
                        <tr>
                            <td colspan="4">
                                Invoice # {{ $order->payment->id }}<br />
                                Created: {{ date_format($order->payment->created_at, 'F j, Y') }}
                            </td>
                            <td style="{{ $order->payment->paid_status ? 'color:green' : 'color:red' }}">
                                {{ $order->payment->paid_status ? 'PAID' : 'UNPAID' }}</td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="5">
                    <table>
                        <tr>
                            <td colspan="3">
                                RafCart<br />
                                12345 Sunny Road<br />
                                Sunnyville, TX 12345
                            </td>
                            <td colspan="2">
                                {{ $order->buyer->first_name }} {{ $order->buyer->last_name }}<br />
                                {{ $order->buyer->address }}<br />
                                {{ $order->buyer->user->email }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td colspan="3">Method</td>
                <td colspan="2">Amount</td>
            </tr>

            <tr class="details">
                <td colspan="3">{{ $order->payment->provider }}</td>
                <td colspan="2">{{ $order->payment->amount }}</td>
            </tr>

            <tr class="heading">
                <td>Id</td>
                <td>Product</td>
                <td>Quantity</td>
                <td>Price</td>
                <td>Sub Total</td>
            </tr>

            @foreach ($order->details as $d)
                <tr class="item">
                    <td>{{ $d->product->id }}</td>
                    <td>{{ $d->product->name }}</td>
                    <td>{{ $d->quantity }}</td>
                    <td>${{ $d->product->price }} </td>
                    <td>${{ $d->product->price * $d->quantity }}</td>
                </tr>
            @endforeach

            <tr class="total">
                <td colspan="3">Total: </td>
                <td colspan="2">${{ $order->price_total }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
