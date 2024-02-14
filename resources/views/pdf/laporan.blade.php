<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice-</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .invoice {
            /* margin: 20px auto; */
            /* width: 80%; */
            /* background-color: #f2f2f2; */
            /* border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px; */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="invoice">
        <h3>Laporan Transaksi {{$status}}</h3>
        <p><strong>Tanggak dibuat:</strong> {{date("j F, Y", strtotime(now()))}}</p>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Invoice</th>
                    <th>Tanggal dan Waktu</th>
                    <th>Status</th>
                    <th>Total harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $ts )
                <tr>
                    <td>{{$index + 1}}</td>
                    <td><a href="{{ route('cetakpdf', ['id' => $ts->invoice]) }}">{{$ts->invoice}}</a></td>
                    <td> {{date("j F, Y h:i A", strtotime($ts->tanggal))}}</td>
                    <td>
                        <div class="badge badge-{{ $ts->status_badge }}">{{$ts->status}}</div>
                    </td>
                    <td>Rp. {{number_format($ts->total_price, 0, ',', '.')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            <p><strong>Total:</strong> Rp. {{ number_format($sumTotalPrice, 0, ',', '.') }}</p>
        </div>
    </div>
</body>

</html>