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
    public function run()
    {
        $peminjamIds = DB::table('peminjam')->limit(8)->pluck('id')->toArray();
        $bukuIds = DB::table('buku')->pluck('id')->toArray();

        $borrowings = [];
        $totalBorrowings = 25;
        for ($i = 0; $i < $totalBorrowings; $i++) {
            $peminjamId = $peminjamIds[array_rand($peminjamIds)];
            $tanggalPinjam = Carbon::now()->subDays(rand(1, 30));
            $tanggalKembali = $tanggalPinjam->copy()->addDays(3);
            // Menentukan apakah tanggal pengembalian null atau tidak
            $random = rand(0, 3);
            switch ($random) {
                case 0:
                    $tanggalPengembalian = $tanggalKembali->copy()->addDays(rand(1, 6));
                    break;
                case 1:
                    $tanggalPengembalian = $tanggalPinjam->copy()->addDays(rand(1, 2));
                    break;
                case 2:
                    $tanggalPengembalian = $tanggalKembali->copy();
                    break;
                default:
                    $tanggalPengembalian = null;
                    break;
            }
            $borrowings[] = [
                'peminjam_id' => $peminjamId,
                'tanggal_pinjam' => $tanggalPinjam,
                'tanggal_kembali' => $tanggalKembali,
                'tanggal_pengembalian' => $tanggalPengembalian,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('pinjaman_buku')->insert($borrowings);

        // Get inserted borrowing IDs
        $borrowingIds = DB::table('pinjaman_buku')->pluck('id')->toArray();

        // Generate details for each borrowing
        $borrowingItems = [];
        foreach ($borrowingIds as $borrowingId) {
            $totalBooks = rand(1, 5); // Generate random number of books for each borrowing
            for ($i = 0; $i < $totalBooks; $i++) {
                $bukuId = $bukuIds[array_rand($bukuIds)];
                $jumlahBuku = rand(1, 3); // Generate random number of copies for each book
                $borrowingItems[] = [
                    'pinjaman_buku_id' => $borrowingId,
                    'buku_id' => $bukuId,
                    'jumlah' => $jumlahBuku,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }
        DB::table('pinjaman_buku_item')->insert($borrowingItems);
    }

}
