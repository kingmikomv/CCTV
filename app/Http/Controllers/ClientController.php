<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pembelian;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function perangkatSaya()
{
    $user_id = auth()->id(); // Lebih ringkas
    $perangkat = Pelanggan::with(['user', 'pembelian']) // Perbaikan syntax relasi
                          ->where('user_id', $user_id)
                          ->get();

    return view("Dashboard.User.Layanan.perangkat", compact("perangkat"));
}

}
