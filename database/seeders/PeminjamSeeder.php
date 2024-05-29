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
            ],
            [
                'nama' => 'Budi Santoso',
                'alamat' => 'Jl. Kemerdekaan No. 20, Bandung',
                'telepon' => '082345678901',
            ],
            [
                'nama' => 'Citra Dewi',
                'alamat' => 'Jl. Pemuda No. 10, Surabaya',
                'telepon' => '083456789012',
            ],
            [
                'nama' => 'Dian Setiawan',
                'alamat' => 'Jl. Diponegoro No. 5, Yogyakarta',
                'telepon' => '085678901234',
            ],
            [
                'nama' => 'Eka Putri',
                'alamat' => 'Jl. Jenderal Sudirman No. 8, Medan',
                'telepon' => '087890123456',
            ],
            [
                'nama' => 'Faisal Ramadhan',
                'alamat' => 'Jl. Gajah Mada No. 15, Semarang',
                'telepon' => '089012345678',
            ],
            [
                'nama' => 'Gita Wijaya',
                'alamat' => 'Jl. Soekarno-Hatta No. 30, Makassar',
                'telepon' => '081234567891',
            ],
            [
                'nama' => 'Hadi Nugroho',
                'alamat' => 'Jl. Raden Intan No. 25, Palembang',
                'telepon' => '082345678912',
            ],
            [
                'nama' => 'Ibrahim Ali',
                'alamat' => 'Jl. Imam Bonjol No. 9, Padang',
                'telepon' => '083456789123',
            ],
            [
                'nama' => 'Joko Susanto',
                'alamat' => 'Jl. Pahlawan No. 3, Balikpapan',
                'telepon' => '085678901234',
            ],
        ];
        DB::table('peminjam')->insert($borrowers);
    }
}
