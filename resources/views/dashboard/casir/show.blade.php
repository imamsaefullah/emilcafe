@extends('layouts.layout')

@section('content')
    <div class="pc-content">
        <div class="card">
            <div class="card-header">
                <h5>Detail Transaksi Kasir #{{ $sale->invoice_number ?? $sale->id }}</h5>
            </div>
            <div class="card-body">

                <p><strong>Tanggal:</strong> {{ $sale->created_at->format('d M Y H:i') }}</p>
                <p><strong>Kasir:</strong> {{ $sale->user->name ?? '-' }}</p>
                <p><strong>Pelanggan:</strong> {{ $sale->customer_name ?? '-' }}</p>

                <table class="table table-bordered mt-3">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($sale->items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->good->nama }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->qty * $item->price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">Total</th>
                        <th>Rp {{ number_format($sale->total, 0, ',', '.') }}</th>
                    </tr>
                    </tfoot>
                </table>

                <a href="{{ route('kasir.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
