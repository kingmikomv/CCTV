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


    public function detailPelanggan($id)
    {
        $pembelian = Pelanggan::with(['pembelian', 'produk'])->findOrFail($id);
        $data = Pembelian::where('pelanggan_id', $id)->with(['pelanggan', 'produk'])->get();
        // dd($data);
        return view("Dashboard.Admin.Pelanggan.Detail.detail", compact('pembelian', 'data'));
    }
    public function editDEtail($id)
    {
        $pembelian = Pembelian::with(['pelanggan', 'produk'])->findOrFail($id);
        $produk = Produk::all();
        //dd($pembelian);
        return view('Dashboard.Admin.Pelanggan.Detail.edit', compact('pembelian', 'produk'));

    }
    public function updateDetail(Request $request, $id)
    {
        // Validasi input (bisa dikembangkan sesuai kebutuhan)
        $request->validate([
            'status_pemasangan' => 'required|string',
            'status_pembayaran' => 'required|string',
            'produk_id' => 'required|integer',
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

        // Ambil data pembelian dari DB
        $pembelian = Pembelian::findOrFail($id);

        // Update field dari form
        $pembelian->status_pemasangan = $request->status_pemasangan;
        $pembelian->status_pembayaran = $request->status_pembayaran;
        $pembelian->produk_id = $request->produk_id;
        $pembelian->alamat = $request->alamat;
        $pembelian->tanggal_pemasangan = $request->tanggal_pemasangan;
        $pembelian->jumlah_kamera_terpasang = $request->jumlah_kamera_terpasang;
        $pembelian->merek_tipe_kamera = $request->merek_tipe_kamera;
        $pembelian->tipe_perekam = $request->tipe_perekam;
        $pembelian->merek_perekam = $request->merek_perekam;
        $pembelian->jumlah_ukuran_harddisk = $request->jumlah_ukuran_harddisk;
        $pembelian->jenis_kabel = $request->jenis_kabel;
        $pembelian->topologi_pemasangan = $request->topologi_pemasangan;
        $pembelian->jenis_akses = $request->jenis_akses;
        $pembelian->akun_username = $request->akun_username;
        $pembelian->akun_password = $request->akun_password;
        $pembelian->device_id_serial = $request->device_id_serial;
        $pembelian->total_biaya_pemasangan = $request->total_biaya_pemasangan;
        $pembelian->rincian_biaya = $request->rincian_biaya;
        $pembelian->tanggal_pembayaran = $request->tanggal_pembayaran;
        $pembelian->metode_pembayaran = $request->metode_pembayaran;


        // Simpan perubahan
        $pembelian->save();

        // Redirect atau response
        return redirect()->back()->with('success', 'Data pembelian berhasil diperbarui!');
    }
    public function hapusDetail($id)
    {
        $pembelian = pembelian::find($id);
        $pembelian->delete();
        return redirect()->back()->with('success', 'Data pembelian berhasil dihapus');
    }


   public function updatePelanggan(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'no_hp' => 'required|string|max:20',
        'alamat' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'nullable|string|min:6' // Optional
    ]);

    // Ambil data pelanggan berdasarkan ID
    $pelanggan = Pelanggan::with('user')->findOrFail($id);

    // Update data pelanggan
    $pelanggan->nama = $request->nama;
    $pelanggan->no_hp = $request->no_hp;
    $pelanggan->alamat = $request->alamat;
    $pelanggan->save();

    // Update data user terkait
    if ($pelanggan->user) {
        $user = $pelanggan->user;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
    }

    return redirect()->back()->with('success', 'Pelanggan berhasil diperbarui');
}


   public function hapusPelanggan($id)
{
    $pelanggan = Pelanggan::with('user')->findOrFail($id);

    // Hapus user terkait jika ada
    if ($pelanggan->user) {
        $pelanggan->user->delete();
    }

    // Hapus data pelanggan
    $pelanggan->delete();

    return redirect()->back()->with('success', 'Pelanggan berhasil dihapus');
}


}
