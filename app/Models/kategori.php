<?php

namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $guarded = [];
     public function produk()
    {
        return $this->hasMany(Produk::class, 'kategori_id');
    }
}
