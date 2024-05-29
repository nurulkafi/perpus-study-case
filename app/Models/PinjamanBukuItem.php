<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinjamanBukuItem extends Model
{
    use HasFactory;
    protected $table = 'pinjaman_buku_item';
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}
