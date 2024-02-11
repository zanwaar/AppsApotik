<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice-{{$transaksi->invoice}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .invoice {
            /* margin: 20px auto; */
            /* width: 80%; */
            /* background-color: #f2f2f2; */
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
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
        <h2>Transaksi Masuk</h2>
        <p><strong>Invoice Number:</strong> {{$transaksi->invoice}}</p>
        <p><strong>Date:</strong> {{date("j F, Y", strtotime($transaksi->tanggal))}}</p>

        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detail as $index => $dt )
                <tr>
                    <td>{{$dt->obat->nama_obat}}</td>
                    <td>{{ $dt->quantity }}</td>
                    <td>Rp. {{number_format($dt->obat->harga_beli, 0, ',', '.')}}</td>
                    <td>Rp. {{number_format($dt->obat->harga_jual, 0, ',', '.')}}</td>
                    <td>Rp. {{number_format($dt->total_price, 0, ',', '.')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            <p><strong>Total:</strong> Rp. {{number_format($transaksi->total_price, 0, ',', '.')}}</p>
        </div>
    </div>
</body>

</html>