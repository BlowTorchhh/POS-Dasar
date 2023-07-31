<?php

namespace App\Http\Controllers;

use App\Models\Barangmasuk;
use App\Models\produk;
use App\Models\User;
use App\Models\pengeluaran;

class HomeController extends Controller
{
    public function index()
    {
      $pengguna = User::count();
      $produk = produk::count();
      $barangmasuk = Barangmasuk::count();
      $pengeluaran = pengeluaran::count();


        return view('home',compact('pengguna','produk','barangmasuk','pengeluaran'));
    }
}
