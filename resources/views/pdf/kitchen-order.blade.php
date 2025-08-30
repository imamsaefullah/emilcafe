<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pesanan #{{ $order->id }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 11px;
            max-width: 250px; /* 58mm printer */
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
            width: 30%;
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
        .footer {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h2>Pesanan #{{ $order->number }}</h2>

<table>
    <tr>
        <td class="label">Meja</td>
        <td>: {{ $order->table_number }}</td>
    </tr>
    <tr>
        <td class="label">Nama</td>
        <td>: {{ $order->customer_name }}</td>
    </tr>
    <tr>
        <td class="label">Status</td>
        <td>: {{ ucfirst($order->statusdapur) }}</td>
    </tr>
</table>

<div class="separator">Menu Dipesan</div>

<table class="menu-table">
    <thead>
    <tr>
        <th>Menu</th>
        <th style="text-align:right;">Qty</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($order->items as $item)
        <tr>
            <td>{{ $item->good->nama ?? '-' }}</td>
            <td style="text-align:right;">{{ $item->qty }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="footer">
    --- Terima Kasih ---
</div>

</body>
</html>
