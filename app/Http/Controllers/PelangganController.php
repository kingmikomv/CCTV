<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PelangganController extends Controller
{
    public function dataPelanggan()
    {
        $pelanggan = Pelanggan::all(); // eager load produk
        $produk = Produk::all();
        return view("Dashboard.Admin.Pelanggan.dataPelanggan", compact('pelanggan', 'produk'));
    }
    public function beliProduk($id){
        $pelanggan = Pelanggan::find($id);
                $produk = Produk::all();
        return view("Dashboard.Admin.Pelanggan.beliProduk", compact('pelanggan', 'produk'));
    }
    public function uploadPelanggan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',

        ]);

        DB::beginTransaction();

        try {
            // 1. Simpan user
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'pelanggan', // sesuaikan jika ada enum/tipe role
                'no_hp' => $request->no_hp,
            ]);

            // 2. Simpan pelanggan
            $pelanggan = Pelanggan::create([
                'user_id' => $user->id,
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);

            // 3. Relasikan produk (jika pakai pivot table seperti pelanggan_produk)


            DB::commit();

            return redirect()->back()->with('success', 'Pelanggan berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function uploadPembelian(Request $request)
    {
        // Validasi input form
        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'status_pemasangan' => 'required|string',
            'status_pembayaran' => 'required|string',
            'produk_id' => 'required|exists:produk,id',
            'pembelian_id' => 'required|string|unique:pembelians,pembelian_id',
        ]);

        // Simpan data pembelian
        $pembelian = new Pembelian();
        $pembelian->pelanggan_id = $validated['pelanggan_id'];
        $pembelian->status_pemasangan = $validated['status_pemasangan'];
        $pembelian->status_pembayaran = $validated['status_pembayaran'];
        $pembelian->produk_id = $validated['produk_id'];
        $pembelian->pembelian_id = $validated['pembelian_id'];
        $pembelian->save();

        // Redirect atau return response
        return redirect()->route('dataPelanggan')->with('success', 'Pembelian berhasil disimpan!');
    }

}
