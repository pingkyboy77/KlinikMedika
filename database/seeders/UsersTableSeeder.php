<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeder untuk Admin
        DB::table('users')->insert([
            'nama' => 'Admin User',
            'role' => 'admin',
            'identitas' => 141002,
            'password' => Hash::make('141002'),
            'kategori' => 'IT',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seeder untuk Mahasiswa
        DB::table('users')->insert([
            'nama' => 'Mahasiswa User',
            'role' => 'mahasiswa',
            'identitas' => 141003,
            'password' => Hash::make('141003'),
            'kategori' => 'Teknik Informatika',
            'status' => 'active',
            'angkatan_tahun' => 2020,
            'prodi' => 'Teknik Informatika',
            'sks_ditempuh' => 90,
            'ipk' => 3.75,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seeder untuk Dosen
        DB::table('users')->insert([
            'nama' => 'Dosen User',
            'role' => 'dosen',
            'identitas' => 141004,
            'password' => Hash::make('141004'),
            'kategori' => 'IT',
            'status' => 'active',
            'NIP' => '1234567890',
            'jenis_kelamin' => 'male',
            'email' => 'dosen@example.com',
            'no_hp' => '081234567890',
            'pangkat_akademik' => 'Lektor',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
