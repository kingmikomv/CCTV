<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function dataProduk()
    {

        $produk = Produk::with('kategori')->get();
        $kategori = Kategori::all();
        return view('Dashboard.Admin.Produk.produk', compact('produk', 'kategori'));
    }
    public function uploadProduk(Request $request)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'required|in:aktif,nonaktif',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Generate slug unik
        $slug = Str::slug($validatedData['nama_produk']);
        $count = Produk::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = $slug . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move('produk', $filename);
            $validatedData['gambar'] = $filename;
        }

        $kode_produk = $this->generateKodeProduk();

        Produk::create([
            'kode_produk' => $kode_produk,

            'nama_produk' => $validatedData['nama_produk'],
            'slug' => $slug,
            'kategori_id' => $validatedData['kategori_id'],
            'harga' => $validatedData['harga'],
            'stok' => $validatedData['stok'],
            'status' => $validatedData['status'],
            'deskripsi' => $validatedData['deskripsi'],
            'gambar' => $validatedData['gambar'] ?? null,
        ]);

        return redirect()->route('dataProduk')->with('success', 'Produk berhasil ditambahkan!');
    }


    private function generateKodeProduk()
    {
        $lastProduk = Produk::orderBy('id', 'desc')->first();
        if (!$lastProduk) {
            return 'PROD001';
        }

        $lastKode = $lastProduk->kode_produk; // contoh: PROD012
        $number = (int) substr($lastKode, 4); // ambil angka setelah "PROD"
        $number++;
        return 'PROD' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }



    public function kategoriProduk()
    {
        $kategoris = kategori::withCount('produk')->get();

        return view('Dashboard.Admin.Produk.kategori', compact('kategoris'));
    }
    public function tambahKategori(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori',
        ]);
        $slug = Str::slug($request->nama_kategori);
        $count = Kategori::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }
        // Simpan kategori
        kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'slug' => $slug,

        ]);

        // Redirect balik ke halaman kategori dengan pesan sukses
        return redirect()->route('kategoriProduk')->with('success', 'Kategori berhasil ditambahkan!');
    }
}
