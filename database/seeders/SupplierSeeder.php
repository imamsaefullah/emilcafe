<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'nama' => 'PT Sumber Makmur',
                'kode' => 'SUP001',
                'alamat' => 'Jl. Merdeka No. 123, Jakarta',
                'telepon' => '021-5551234',
                'email' => 'makmur@supplier.com',
                'kontak_person' => 'Andi Setiawan',
                'keterangan' => 'Supplier bahan baku plastik',
            ],
            [
                'nama' => 'CV Tunas Jaya',
                'kode' => 'SUP002',
                'alamat' => 'Jl. Raya Bogor Km. 21, Bogor',
                'telepon' => '0251-8881122',
                'email' => 'tunasjaya@gmail.com',
                'kontak_person' => 'Rina Marlina',
                'keterangan' => 'Sparepart elektronik dan komponen',
            ],
            [
                'nama' => 'UD Aneka Logam',
                'kode' => 'SUP003',
                'alamat' => 'Jl. Industri No. 10, Surabaya',
                'telepon' => '031-7334455',
                'email' => 'aneka@logam.co.id',
                'kontak_person' => 'Budi Santoso',
                'keterangan' => 'Spesialis logam dan bahan bangunan',
            ],
            [
                'nama' => 'PT Kimia Nusantara',
                'kode' => 'SUP004',
                'alamat' => 'Jl. Kimia No. 5, Bandung',
                'telepon' => '022-7070707',
                'email' => 'info@kimianusantara.com',
                'kontak_person' => 'Dewi Lestari',
                'keterangan' => 'Supplier bahan kimia industri',
            ],
            [
                'nama' => 'CV Indo Plastik',
                'kode' => 'SUP005',
                'alamat' => 'Jl. Pabrik No. 8, Tangerang',
                'telepon' => '021-9993344',
                'email' => 'cs@indoplastik.com',
                'kontak_person' => 'Ferry Gunawan',
                'keterangan' => 'Plastik kemasan dan produk turunan',
            ],
        ];

        foreach ($suppliers as $supplier) {
            DB::table('suppliers')->insert([
                ...$supplier,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
