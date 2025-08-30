@extends('layouts.layout')

@section('content')
    <div class="pc-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Daftar Barang</h4>
            <a href="{{ route('goods.create') }}" class="btn btn-primary btn-sm">+ Tambah Barang</a>
        </div>

        <div class="row">
            @forelse($goods as $good)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if ($good->gambar)
                            <img src="{{ asset('storage/' . $good->gambar) }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="{{ $good->nama }}">
                        @else
                            <div class="text-center py-5 text-muted" style="background: #f8f9fa;">Tidak ada gambar</div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between mb-2">
                                <h5 class="card-title mb-0">{{ $good->nama }}</h5>
                                <h6 class="text-success mb-0">Rp {{ number_format($good->harga_jual) }}</h6>
                            </div>
                            <p class="card-text text-muted mt-1">{{ Str::limit($good->keterangan, 60) }}</p>
                            <div class="mt-auto">
                                <a href="{{ route('goods.edit', $good->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('goods.destroy', $good->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Hapus barang ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <div class="alert alert-info">Belum ada barang.</div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
