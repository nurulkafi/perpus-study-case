<?php

namespace App\Http\Controllers;

use App\Models\PinjamanBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bukuDipinjam = PinjamanBuku::join('pinjaman_buku_item', 'pinjaman_buku.id', '=', 'pinjaman_buku_item.pinjaman_buku_id')
            ->join('buku', 'pinjaman_buku_item.buku_id', '=', 'buku.id')
            ->join('peminjam', 'pinjaman_buku.peminjam_id', '=', 'peminjam.id')
            ->whereNull('pinjaman_buku.tanggal_pengembalian')
            ->select('buku.judul as judul_buku', 'peminjam.nama as nama_peminjam', 'tanggal_kembali')
            ->orderBy('buku.judul', 'asc')
            ->get();
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
        $peminjamanList = PinjamanBuku::with('peminjam')
            ->with('items.buku')
            ->get();
        return view('peminjaman.index', compact('bukuDipinjam', 'denda', 'peminjamanList'));
    }
    public function detailJson($id)
    {
        $peminjaman = PinjamanBuku::with('items.buku')
            ->where('id', $id)
            ->first();

        return response()->json($peminjaman);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
