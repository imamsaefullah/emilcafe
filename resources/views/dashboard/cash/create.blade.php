@extends('layouts.layout')

@section('content')
    <div class="pc-content">
        <div class="card">
            <div class="card-header">
                <h5>Form Input Kas</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('cash.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Tanggal -->
                            <div class="form-group">
                                <label class="form-label" for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>

                            <!-- Jenis Kas -->
                            <div class="form-group">
                                <label class="form-label" for="jenis">Jenis Transaksi</label>
                                <select class="form-select" id="jenis" name="jenis" required>
                                    <option value="">Pilih Jenis</option>
                                    <option value="masuk">Kas Masuk</option>
                                    <option value="keluar">Kas Keluar</option>
                                </select>
                            </div>

                            <!-- Kode -->
                            <div class="form-group">
                                <label class="form-label" for="kode">Kode Transaksi</label>
                                <input type="text" class="form-control" id="kode" name="kode" placeholder="Contoh: KAS001">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Deskripsi -->
                            <div class="form-group">
                                <label class="form-label" for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Keterangan transaksi"></textarea>
                            </div>

                            <!-- Jumlah -->
                            <div class="form-group">
                                <label class="form-label" for="jumlah">Jumlah (Rp)</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                        <a href="{{ route('cash.index') }}" class="btn btn-secondary"> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
