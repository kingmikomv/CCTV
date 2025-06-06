<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cctv extends Model
{
    use HasFactory;

    protected $table = 'cctvs';
    protected $guarded = [];
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
