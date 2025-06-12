<?php

namespace App\Models;

use App\Models\kategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $guarded = [];
    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'kategori_id');
    }
    public function pelanggans()
    {
        return $this->belongsToMany(Pelanggan::class, 'pembelians');
    }
    public function gangguans()
    {
        return $this->hasMany(Gangguan::class);
    }
}
