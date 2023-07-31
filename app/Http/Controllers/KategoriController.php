<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\produk;
use App\Models\Barangmasuk;
use App\Models\pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index()
    {
        $data = kategori::all();
        $count = $data->count();
        return view('kategori/kategori',['data'=>$data],compact('count'));
    }

    public function add()
    {
        return view('kategori/kategori-add');
    }
    public function addProcess(Request $request)
    {
        $request->validate([
            'kategori' => 'required|unique:kategori'
        ]);

        DB::table('kategori')->insert([
            'kategori' => $request->kategori
          
        ]);
        return redirect('kategori/kategori')->with('status', 'Kategori Berhasil ditambah!');
    }
    public function edit($id)
    {
        $kategori = DB::table('kategori')->where('id', $id)->first();
        return view('kategori/kategori-edit', compact('kategori'));
    }
    public function editProcess(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'required|unique:kategori'
        ]);
        DB::table('kategori')->where('id', $id)
            ->update([
                'kategori' => $request->kategori
            ]);
            return redirect('kategori/kategori')->with('status', 'kategori Berhasil diedit!');
    }

    public function delete($id)
    {
        $pro = produk::count();
        if ($pro >= 1) {
        $produk = produk::all($produk = ['*'])->where('kategori_id', $id);
        foreach ($produk as $pr){
            DB::table('barang_masuk')->where('produk_id', $pr->id)->delete();
            DB::table('pengeluaran')->where('produk_id', $pr->id)->delete();
            DB::table('produk')->where('kategori_id', $id)->delete();
            }
           
            
        }
        DB::table('kategori')->where('id', $id)->delete();
            return redirect('kategori/kategori')->with('status', 'Kategori beserta Produk, Barang Masuk dan Pengeluaran yang bersangkutan Berhasil dihapus!');
    }
}
