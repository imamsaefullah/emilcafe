<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@emilcafe.com'], // gunakan email unik agar tidak dobel saat dijalankan ulang
            [
                'name' => 'Super Admin',
                'password' => Hash::make('123456'), // ganti password sesuai kebutuhan
                'username' => 'superadmin',
                'role' => 'superadmin', // pastikan ada kolom `role` di tabel `users`
                'profile_photo' => 'emil.png'
            ]
        );
    }
}
