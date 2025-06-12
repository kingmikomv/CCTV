<?php

namespace App\Models;

use App\Models\Cctv;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggans';
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'pembelians');
    }
    public function pembelian()
    {
        return $this->hasMany(Pembelian::class);
    }
    public function gangguans()
    {
        return $this->hasMany(Gangguan::class);
    }
}
