@extends('layouts.layout')

@section('content')
    <div class="pc-content">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Detail Barang</h5>
                <a href="{{ route('goods.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Kode Barang</dt>
                    <dd class="col-sm-9">{{ $goods->kode }}</dd>

                    <dt class="col-sm-3">Nama Barang</dt>
                    <dd class="col-sm-9">{{ $goods->nama }}</dd>

                    <dt class="col-sm-3">Kategori</dt>
                    <dd class="col-sm-9">{{ ucfirst($goods->kategori) }}</dd>

                    <dt class="col-sm-3">Satuan</dt>
                    <dd class="col-sm-9">{{ strtoupper($goods->satuan) }}</dd>

                    <dt class="col-sm-3">Stok</dt>
                    <dd class="col-sm-9">{{ $goods->stok }}</dd>

                    <dt class="col-sm-3">Harga Beli</dt>
                    <dd class="col-sm-9">Rp {{ number_format($goods->harga_beli, 0, ',', '.') }}</dd>

                    <dt class="col-sm-3">Harga Jual</dt>
                    <dd class="col-sm-9">Rp {{ number_format($goods->harga_jual, 0, ',', '.') }}</dd>

                    <dt class="col-sm-3">Keterangan</dt>
                    <dd class="col-sm-9">{{ $goods->keterangan ?? '-' }}</dd>
                </dl>

                <h6 class="mt-4">Riwayat Perubahan Stok</h6>
                <table class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Tipe</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($goods->histories as $history)
                        <tr>
                            <td>{{ $history->tanggal }}</td>
                            <td>{{ ucfirst($history->tipe) }}</td>
                            <td>{{ $history->jumlah }}</td>
                            <td>{{ $history->keterangan ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada riwayat stok.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
