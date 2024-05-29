<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinjamanBuku extends Model
{
    use HasFactory;

    protected $table = 'pinjaman_buku';

    protected $guarded = [''];
    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class, 'peminjam_id');
    }
    public function items()
    {
        return $this->hasMany(PinjamanBukuItem::class, 'pinjaman_buku_id');
    }
}
