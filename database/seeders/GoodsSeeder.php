<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Good;

class GoodsSeeder extends Seeder
{
    public function run(): void
    {
        $goods = [
            // Sarapan & Pembuka
            [
                'nama' => 'Lontong Sayur',
                'harga_jual' => 15000,
                'keterangan' => 'Lontong disajikan dengan kuah santan, labu siam, tahu, dan telur rebus.',
                'gambar' => 'goods/barang1.jpg',
            ],
            [
                'nama' => 'Bubur Ayam',
                'harga_jual' => 12000,
                'keterangan' => 'Bubur nasi hangat dengan suwiran ayam, kacang kedelai goreng, dan kerupuk.',
                'gambar' => 'goods/barang2.jpg',
            ],
            [
                'nama' => 'Tahu Isi',
                'harga_jual' => 6000,
                'keterangan' => 'Tahu goreng berisi sayuran dan bihun, cocok sebagai camilan pembuka.',
                'gambar' => 'goods/barang3.jpg',
            ],
            [
                'nama' => 'Pisang Goreng',
                'harga_jual' => 8000,
                'keterangan' => 'Pisang matang dibalut tepung renyah, pas untuk teman teh pagi.',
                'gambar' => 'goods/barang4.jpg',
            ],

            // Hidangan Utama
            [
                'nama' => 'Nasi Goreng Spesial',
                'harga_jual' => 22000,
                'keterangan' => 'Nasi goreng dengan telur, ayam suwir, sosis, dan kerupuk.',
                'gambar' => 'goods/barang5.jpg',
            ],
            [
                'nama' => 'Ayam Geprek',
                'harga_jual' => 20000,
                'keterangan' => 'Ayam goreng tepung dengan sambal geprek pedas dan lalapan segar.',
                'gambar' => 'goods/barang6.jpg',
            ],
            [
                'nama' => 'Mie Ayam Bakso',
                'harga_jual' => 18000,
                'keterangan' => 'Mie kenyal dengan potongan ayam manis dan bakso sapi.',
                'gambar' => 'goods/barang7.jpg',
            ],
            [
                'nama' => 'Soto Ayam Lamongan',
                'harga_jual' => 19000,
                'keterangan' => 'Soto bening khas Lamongan dengan koya, suwiran ayam, dan telur rebus.',
                'gambar' => 'goods/barang8.jpg',
            ],

            // Makan Malam
            [
                'nama' => 'Ikan Bakar Kecap',
                'harga_jual' => 28000,
                'keterangan' => 'Ikan gurame bakar dengan bumbu kecap manis dan sambal terasi.',
                'gambar' => 'goods/barang9.jpg',
            ],
            [
                'nama' => 'Nasi Liwet Komplit',
                'harga_jual' => 25000,
                'keterangan' => 'Nasi gurih dengan ayam goreng, tahu, tempe, sambal dan lalapan.',
                'gambar' => 'goods/barang10.jpg',
            ],
            [
                'nama' => 'Sate Ayam',
                'harga_jual' => 23000,
                'keterangan' => 'Sate ayam bumbu kacang disajikan dengan lontong dan bawang goreng.',
                'gambar' => 'goods/barang11.jpg',
            ],
            [
                'nama' => 'Rawon Daging',
                'harga_jual' => 30000,
                'keterangan' => 'Sup daging khas Jawa Timur dengan kuah hitam dari kluwek, lengkap dengan nasi dan sambal.',
                'gambar' => 'goods/barang12.jpg',
            ],

            // Makanan Penutup
            [
                'nama' => 'Es Cendol',
                'harga_jual' => 10000,
                'keterangan' => 'Minuman dingin khas Indonesia dengan cendol, santan, dan gula merah cair.',
                'gambar' => 'goods/barang13.jpg',
            ],
            [
                'nama' => 'Kolak Pisang',
                'harga_jual' => 9000,
                'keterangan' => 'Pisang rebus dalam kuah santan manis dengan tambahan ubi dan kolang-kaling.',
                'gambar' => 'goods/barang14.jpg',
            ],
            [
                'nama' => 'Es Campur',
                'harga_jual' => 12000,
                'keterangan' => 'Campuran buah segar, agar-agar, cincau, dan sirup manis disajikan dengan es serut.',
                'gambar' => 'goods/barang15.jpg',
            ],
            [
                'nama' => 'Puding Cokelat',
                'harga_jual' => 11000,
                'keterangan' => 'Puding lembut rasa cokelat disajikan dengan saus vla vanila dingin.',
                'gambar' => 'goods/barang16.jpg',
            ],
        ];

        foreach ($goods as $item) {
            Good::create($item);
        }
    }
}
