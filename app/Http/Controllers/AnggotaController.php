<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use App\Models\PinjamanBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjam = Peminjam::all();
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

        return view('anggota.index', compact('peminjam', 'peminjamList'));
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
    public function detailJson($id)
    {
        $peminjaman = PinjamanBuku::with('items.buku')
            ->where('peminjam_id', $id)
            ->get();

        return response()->json($peminjaman);
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
