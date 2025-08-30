@extends('layouts.layout')

@section('content')
    <div class="pc-content">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Edit Barang</h5>
                <a href="{{ route('goods.index') }}" class="btn btn-sm btn-outline-secondary">← Kembali</a>
            </div>

            <div class="card-body">
                <form action="{{ route('goods.update', $good->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Nama & Harga --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="nama" value="{{ old('nama', $good->nama) }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Harga Jual</label>
                            <input type="number" name="harga_jual" value="{{ old('harga_jual', $good->harga_jual) }}" class="form-control" required>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan', $good->keterangan) }}</textarea>
                    </div>

                    {{-- Gambar --}}
                    <div class="mb-3">
                        <label class="form-label">Gambar</label><br>
                        @if ($good->gambar)
                            <img src="{{ asset('storage/' . $good->gambar) }}" alt="Preview" class="img-thumbnail mb-2" style="max-height: 150px;">
                        @endif
                        <input type="file" name="gambar" class="form-control">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('goods.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy"></i> Update Barang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
