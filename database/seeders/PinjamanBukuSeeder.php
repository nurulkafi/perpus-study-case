<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PinjamanBukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $borrowings = [
            [
                'peminjam_id' => 1,
                'buku_id' => 1,
                'tanggal_pinjam' => Carbon::now()->subDays(10),
                'tanggal_kembali' => Carbon::now()->addDays(4),
                'tanggal_pengembalian' => Carbon::now()->subDays(5),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'peminjam_id' => 2,
                'buku_id' => 2,
                'tanggal_pinjam' => Carbon::now()->subDays(20),
                'tanggal_kembali' => Carbon::now()->subDays(6),
                'tanggal_pengembalian' => Carbon::now()->subDays(5),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'peminjam_id' => 3,
                'buku_id' => 3,
                'tanggal_pinjam' => Carbon::now()->subDays(5),
                'tanggal_kembali' => Carbon::now()->addDays(9),
                'tanggal_pengembalian' => Carbon::now()->subDays(5),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('pinjaman_buku')->insert($borrowings);
    }
}
