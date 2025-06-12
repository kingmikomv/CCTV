<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Gate::allows('isAdmin')) {
            $totalPelanggan = Pelanggan::count();

            // Asumsikan satu pembelian punya satu produk. Kalau ada quantity, tinggal sesuaikan.
            $totalProdukDibeli = Pembelian::count();
            return view('Dashboard.Admin.index', compact('totalPelanggan', 'totalProdukDibeli'));
        } elseif (Gate::allows('isUser')) {
            return view('Dashboard.User.index');
        }

        abort(403, 'Unauthorized');
    }
}
