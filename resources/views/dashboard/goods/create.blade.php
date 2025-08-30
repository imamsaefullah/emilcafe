@extends('layouts.layout')

@section('content')
    <div class="pc-content">
        <div class="card">
            <div class="card-header">
                <h5>Tambah Barang</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('goods.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Nama dan Harga -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama Barang</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Contoh: Kopi Latte" required>
                        </div>
                        <div class="col-md-6">
                            <label for="harga_jual" class="form-label">Harga</label>
                            <input type="number" name="harga_jual" id="harga_jual" class="form-control" placeholder="Contoh: 15000" required>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label for="keterangan" class="form-label">Deskripsi</label>
                        <textarea name="keterangan" id="keterangan" rows="3" class="form-control" placeholder="Tulis deskripsi singkat..."></textarea>
                    </div>

                    <!-- Gambar -->
                    <div class="mb-4">
                        <label for="gambar" class="form-label">Upload Gambar Produk</label>
                        <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*" required>
                    </div>

                    <!-- Tombol -->
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('goods.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
