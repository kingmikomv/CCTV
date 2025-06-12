<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gangguan extends Model
{
    use HasFactory;

    protected $fillable = [
        'gangguan_id',
        'user_id',
        'pembelian_id',
        'pelanggan_id',
        'produk_id',
        'deskripsi',
        'foto_gangguan',
    ];

    protected $casts = [
        'foto_gangguan' => 'array',
    ];

    public static function generateGangguanId()
    {
        $last = self::orderBy('id', 'desc')->first();
        $number = $last ? ((int)substr($last->gangguan_id, 3)) + 1 : 1;
        return 'GGN' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }

    // Relasi
    public function user()       { return $this->belongsTo(User::class); }
    public function pembelian()  { return $this->belongsTo(Pembelian::class); }
    public function pelanggan()  { return $this->belongsTo(Pelanggan::class); }
    public function produk()     { return $this->belongsTo(Produk::class); }
}
