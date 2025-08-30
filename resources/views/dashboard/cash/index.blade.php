@extends('layouts.layout')

@section('content')
    <div class="pc-content">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Data Kas</h5>
                <a href="{{ route('cash.create') }}" class="btn btn-primary btn-sm">+ Tambah Transaksi Kas</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Kode</th>
                        <th>Deskripsi</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($kas as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ ucfirst($item->jenis) }}</td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td>Rp{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('kas.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('kas.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus data ini?')" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if($kas->isEmpty())
                        <tr><td colspan="7" class="text-center">Belum ada transaksi kas.</td></tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
