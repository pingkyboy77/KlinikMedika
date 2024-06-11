<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            [
            'kategori' => 'Human Computer Interaction',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'kategori' => 'Computer Security and Reliability',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'kategori' => 'Computer Graphics',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'kategori' => 'Artificial Intelligence',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'kategori' => 'Information Science',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'kategori' => 'Programming Languanges',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'kategori' => 'Business Informatics',
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ];

        DB::table('kategoris')->insert($kategori);
    }
}
