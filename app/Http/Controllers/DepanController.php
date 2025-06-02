<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class DepanController extends Controller
{
    public function index(){
        return view("Frontend/index");
    }
    public function belanja(){
         $produks = Produk::where('status', 'aktif')->latest()->take(6)->get();
        return view("Frontend/belanja", compact("produks"));

    }
    public function belanjaShow($slug){
         $produk = Produk::where('slug', $slug)->firstOrFail();
    return view('Frontend/show', compact('produk'));
    }
}
