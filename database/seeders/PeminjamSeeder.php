<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeminjamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $borrowers = [
            [
                'nama' => 'Ahmad Syah',
                'alamat' => 'Jl. Merdeka No. 1, Jakarta',
                'telepon' => '081234567890',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Budi Santoso',
                'alamat' => 'Jl. Kemerdekaan No. 20, Bandung',
                'telepon' => '082345678901',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Citra Dewi',
                'alamat' => 'Jl. Pemuda No. 10, Surabaya',
                'telepon' => '083456789012',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('peminjam')->insert($borrowers);
    }
}
