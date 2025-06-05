<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $guarded = [];
protected $casts = [
    'tanggal_pemasangan' => 'date', // atau 'datetime'
    'tanggal_pembayaran' => 'date',
];

    // Relasi (optional, jika ingin relasi ke tabel lain)
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
