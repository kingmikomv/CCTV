<?php

namespace App\Http\Controllers;

use App\Models\Gangguan;
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
    public function detailPerangkat($id)
    {
        $pelanggan = Pelanggan::with(['user', 'pembelian.produk']) // pastikan eager load produk
            ->where('id', $id)
            ->firstOrFail();

        // Ambil satu data pembelian jika hanya satu, atau bisa juga foreach jika banyak
        $pembelian = $pelanggan->pembelian->first(); // Gunakan first() jika hanya satu perangkat

        return view("Dashboard.User.Layanan.detailPerangkat", compact("pelanggan", "pembelian"));
    }
    public function gangguanUser()
    {
        $user_id = auth()->id(); // Lebih ringkas
        $gangguan = Pembelian::with(['pelanggan.user', 'produk'])
            ->whereHas('pelanggan', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
            ->get();
        $laporanGangguan = Gangguan::with(['produk', 'pembelian'])
            ->where('user_id', $user_id)
            ->latest()
            ->get();
        return view("Dashboard.User.Misc.gangguanUser", compact("gangguan", "laporanGangguan"));
    }


    public function uploadGangguan(Request $request)
    {
        $request->validate([
            'pembelian_id' => 'required|exists:pembelians,id',
            'deskripsi' => 'required|string',
            'foto_gangguan' => 'nullable|array',
            'foto_gangguan.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $pembelian = Pembelian::with(['pelanggan', 'produk'])->findOrFail($request->pembelian_id);

        $fotoPaths = [];

        if ($request->hasFile('foto_gangguan')) {
            foreach ($request->file('foto_gangguan') as $foto) {
                // Generate nama unik
                $filename = uniqid() . '_' . time() . '.' . $foto->getClientOriginalExtension();

                // Simpan ke folder public/gangguan
                $foto->move(public_path('gangguan'), $filename);

                // Simpan path relative untuk akses via URL
                $fotoPaths[] = 'gangguan/' . $filename;
            }
        }


        Gangguan::create([
            'gangguan_id'   => Gangguan::generateGangguanId(), // custom static method di model
            'user_id'       => auth()->id(),
            'pembelian_id'  => $pembelian->id,
            'pelanggan_id'  => $pembelian->pelanggan_id,
            'produk_id'     => $pembelian->produk_id,
            'deskripsi'     => $request->deskripsi,
            'foto_gangguan' => $fotoPaths, // disimpan sebagai array (pastikan field-nya JSON)
        ]);

        return redirect()->back()->with('success', 'Laporan gangguan berhasil dikirim.');
    }
}
