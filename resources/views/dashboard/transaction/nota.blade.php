<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembelian #{{ $transaction->number }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 11px;
            max-width: 250px; /* cocok untuk printer 58mm */
            margin: 0 auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 6px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }
        td {
            padding: 4px 0;
            vertical-align: top;
        }
        .label {
            width: 35%;
            font-weight: bold;
        }
        .separator {
            text-align: center;
            margin: 10px 0;
            border-top: 1px dashed #aaa;
        }
        .menu-table {
            width: 100%;
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            margin-top: 6px;
        }
        .menu-table th, .menu-table td {
            text-align: left;
            padding: 4px 0;
        }
        .menu-table th {
            border-bottom: 1px dashed #999;
        }
        .menu-table td.qty {
            text-align: right;
        }
        .summary-table {
            width: 100%;
            margin-top: 10px;
        }
        .summary-table td {
            padding: 2px 0;
        }
        .summary-table td.label {
            width: 60%;
            text-align: left;
            font-weight: bold;
        }
        .summary-table td.value {
            width: 40%;
            text-align: right;
        }
        .footer {
            text-align: center;
            margin-top: 10px;
        }
        /* Judul berwarna */
        .cafe {
            font-weight: bold;
            font-size: 26px;
            text-align: center;
            color: #2e7d32; /* Hijau tua, bisa diganti sesuai tema */
            margin: 4px 0;
        }
        .mt-2{
            margin-top: 10px;
        }
        .align-center {
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>
<body>

<p class="cafe">
    Emil Cafe</p>
<h2>Struk Pembelian</h2>


<div class="separator"></div>
<p class="align-center">Pengampelan, Kec. Walantaka, Kota Serang, Banten 42183</p>
<div class="separator"></div>
<table>
    <tr>
        <td class="label">Tanggal</td>
        <td>: {{ $transaction->created_at->format('d-m-Y H:i') }}</td>
    </tr>
    <tr>
        <td class="label">No. Transaksi</td>
        <td>: {{ $transaction->number }}</td>
    </tr>
    <tr>
        <td class="label">Nama</td>
        <td>: {{ $transaction->customer_name ?? '-' }}</td>
    </tr>
    <tr>
        <td class="label">Meja</td>
        <td>: {{ $transaction->table_number ?? '-' }}</td>
    </tr>
</table>

<div class="separator"></div>

<p class="align-center">Detail Pembelian</p>

<table class="menu-table">
    <thead>
    <tr>
        <th>Item</th>
        <th class="qty">Qty</th>
        <th class="qty">Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($transaction->items as $item)
        <tr>
            <td>{{ $item->good->nama ?? '-' }}</td>
            <td class="qty">{{ $item->qty }}</td>
            <td class="qty">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<table class="summary-table">
    <tr>
        <td class="label">Total</td>
        <td class="value">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td class="label">Bayar</td>
        <td class="value">Rp {{ number_format($transaction->paid, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td class="label">Kembali</td>
        <td class="value">Rp {{ number_format($transaction->change, 0, ',', '.') }}</td>
    </tr>
</table>

<div class="footer">
    --- Terima Kasih ---
</div>

</body>
</html>
