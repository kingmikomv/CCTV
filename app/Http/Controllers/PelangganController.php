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
    public function beliProduk($id)
    {
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
        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'status_pemasangan' => 'required|string',
            'status_pembayaran' => 'required|string',
            'produk_id' => 'required|exists:produk,id',
            'pembelian_id' => 'required|string|unique:pembelians,pembelian_id',
            'alamat' => 'nullable|string',
            'tanggal_pemasangan' => 'nullable|date',
            'jumlah_kamera_terpasang' => 'nullable|integer',
            'merek_tipe_kamera' => 'nullable|string',
            'tipe_perekam' => 'nullable|string',
            'merek_perekam' => 'nullable|string',
            'jumlah_ukuran_harddisk' => 'nullable|string',
            'jenis_kabel' => 'nullable|string',
            'topologi_pemasangan' => 'nullable|string',
            'jenis_akses' => 'nullable|string',
            'akun_username' => 'nullable|string',
            'akun_password' => 'nullable|string',
            'device_id_serial' => 'nullable|string',
            'total_biaya_pemasangan' => 'nullable|numeric',
            'rincian_biaya' => 'nullable|string',
            'tanggal_pembayaran' => 'nullable|date',
            'metode_pembayaran' => 'nullable|string',

            'bukti_transfer' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'foto_instalasi.*' => 'nullable|file|mimes:jpg,jpeg,png',
            'gambar_denah_lokasi' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'bukti_transaksi' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        $pembelian = new Pembelian();
        $pembelian->fill($validated); // mass assign fields

        // Upload Bukti Transfer
        // Upload Bukti Transfer
        if ($request->hasFile('bukti_transfer')) {
            $pembelian->bukti_transfer = $request->file('bukti_transfer')->store('pembelian/bukti_transfer', 'public');
        }

        // Upload Foto Instalasi
        if ($request->hasFile('foto_instalasi')) {
            $fotoPaths = [];
            foreach ($request->file('foto_instalasi') as $file) {
                $fotoPaths[] = $file->store('pembelian/foto_instalasi', 'public');
            }
            $pembelian->foto_instalasi = json_encode($fotoPaths); // simpan sebagai JSON
        }

        // Upload Gambar Denah Lokasi
        if ($request->hasFile('gambar_denah_lokasi')) {
            $pembelian->gambar_denah_lokasi = $request->file('gambar_denah_lokasi')->store('pembelian/gambar_denah_lokasi', 'public');
        }

        // Upload Bukti Transaksi
        if ($request->hasFile('bukti_transaksi')) {
            $pembelian->bukti_transaksi = $request->file('bukti_transaksi')->store('pembelian/bukti_transaksi', 'public');
        }


        $pembelian->save();

        return redirect()->route('dataPelanggan')->with('success', 'Pembelian berhasil disimpan!');
    }


    public function detailPelanggan($id){
        $pembelian = Pelanggan::with(['pembelian', 'produk'])->findOrFail($id);
        $data = Pembelian::where('pelanggan_id', $id)->with(['pelanggan', 'produk'])->get();
       // dd($data);
  return view("Dashboard.Admin.Pelanggan.Detail.detail", compact('pembelian', 'data'));
    }

}
