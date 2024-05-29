<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjam;
use App\Models\PinjamanBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    //
    public function index()
    {
        // Ambil semua buku
        $buku = Buku::all();

        // Ambil buku yang sedang dipinjam
        $bukuDipinjam = PinjamanBuku::join('pinjaman_buku_item', 'pinjaman_buku.id', '=', 'pinjaman_buku_item.pinjaman_buku_id')
            ->join('buku', 'pinjaman_buku_item.buku_id', '=', 'buku.id')
            ->join('peminjam', 'pinjaman_buku.peminjam_id', '=', 'peminjam.id')
            ->whereNull('pinjaman_buku.tanggal_pengembalian')
            ->select('buku.judul as judul_buku', 'peminjam.nama as nama_peminjam', 'tanggal_kembali')
            ->orderBy('buku.judul', 'asc')
            ->get();

        // Ambil top 10 buku yang sering dipinjam
        $topBuku = PinjamanBuku::join('pinjaman_buku_item', 'pinjaman_buku.id', '=', 'pinjaman_buku_item.pinjaman_buku_id')
            ->join('buku', 'pinjaman_buku_item.buku_id', '=', 'buku.id')
            ->select('buku.id as buku_id', 'buku.judul', DB::raw('COUNT(*) as jumlah_pinjaman'))
            ->groupBy('buku.id', 'buku.judul')
            ->orderByDesc('jumlah_pinjaman')
            ->limit(10)
            ->get();

        // Ambil data denda keterlambatan
        $denda = PinjamanBuku::join('pinjaman_buku_item', 'pinjaman_buku.id', '=', 'pinjaman_buku_item.pinjaman_buku_id')
            ->join('buku', 'pinjaman_buku_item.buku_id', '=', 'buku.id')
            ->join('peminjam', 'pinjaman_buku.peminjam_id', '=', 'peminjam.id')
            ->select(
                'buku.judul AS judul_buku',
                'peminjam.nama AS nama_peminjam',
                DB::raw('DATEDIFF(pinjaman_buku.tanggal_pengembalian, pinjaman_buku.tanggal_kembali) AS telat_pengembalian_hari'),
                DB::raw('CASE WHEN pinjaman_buku.tanggal_pengembalian > pinjaman_buku.tanggal_kembali THEN DATEDIFF(pinjaman_buku.tanggal_pengembalian, pinjaman_buku.tanggal_kembali) * 5000 ELSE 0 END AS total_denda')
            )
            ->whereRaw('pinjaman_buku.tanggal_pengembalian > pinjaman_buku.tanggal_kembali')
            ->get();

        // Ambil data peminjam beserta total pinjaman
        $peminjamList = Peminjam::leftJoin('pinjaman_buku', 'peminjam.id', '=', 'pinjaman_buku.peminjam_id')
            ->leftJoin('pinjaman_buku_item', 'pinjaman_buku.id', '=', 'pinjaman_buku_item.pinjaman_buku_id')
            ->select('peminjam.id as peminjam_id', 'peminjam.nama as nama_peminjam')
            ->selectRaw('(SELECT COUNT(*) FROM pinjaman_buku WHERE pinjaman_buku.peminjam_id = peminjam.id) as total_pinjaman')
            ->selectRaw('SUM(pinjaman_buku_item.jumlah) as total_buku_dipinjam') // Hitung jumlah buku yang dipinjam
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('pinjaman_buku')
                      ->whereRaw('pinjaman_buku.peminjam_id = peminjam.id');
            })
            ->groupBy('peminjam.id', 'peminjam.nama')
            ->get();

        return view('buku.index', compact('buku', 'bukuDipinjam', 'topBuku', 'denda', 'peminjamList'));
    }
}
