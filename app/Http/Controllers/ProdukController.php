<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\CallLike;
use PhpParser\Node\Stmt\TryCatch;

class ProdukController extends Controller
{
    public function index()
    {
        $data = produk::with('kategori')->paginate(10);
        $count = produk::with('kategori')->count();
        return view('produk/produk',['data'=>$data],compact('count'));
       
    }

    public function add()
    {   $kate=kategori::all();
        return view('produk/produk-add',compact('kate'));
    }
    public function addProcess(Request $request)
    {
        try {
            $request->validate([
                'nama_produk' =>'required',
                'kode'=> 'required',
                'kategori_id'=> 'required',
                'merk'=> 'required',
                'harga_jual'=> 'required',
                'harga_beli'=> 'required',
        ]);
        $valid = DB::table('produk')->where(['nama_produk' => $request->nama_produk , 'merk'=> $request->merk]);
        $count = $valid->count();
        $kode = DB::table('produk')->where('kode', $request->kode);
        $kount = $kode->count();
        if ($count >= 1) {
            return redirect('produk/produk')->with('error', 'Nama Barang dan Merknya sudah ada!');
        }
        if ($kount >= 1) {
            return redirect('produk/produk-add')->with('error', 'kode barang sudah ada!');
        }
            DB::table('produk')->insert([
                'nama_produk' => $request->nama_produk,
                'kode'=> $request->kode,
                'kategori_id'=> $request->kategori_id,
                'merk'=>$request->merk,
                'harga_jual'=>$request->harga_jual,
                'harga_beli'=>$request->harga_beli,
            ]);
           
        } catch (\Throwable $th) {
            return redirect('produk/produk-add')->with('error', 'Mohon pilih kategori!');
        }
        return redirect('produk/produk')->with('status', 'product Berhasil ditambah!');
    }
    public function edit($id)
    {
        $kate=kategori::all();
        $data = produk::with('kategori')->findorfail($id);
        return view('produk/produk-edit', compact('data','kate'));
    
    }
    public function editProcess(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_produk' =>'required',
                'kode'=> 'required',
                'merk'=> 'required',
                'harga_jual'=> 'required',
                'harga_beli'=> 'required',
        ]);
        $valid = DB::table('produk')->where('nama_produk' , $request->nama_produk)->where('merk', $request->merk)->get();
        $kode = DB::table('produk')->where('kode', $request->kode)->get();
        $count = $valid->count();
        $kount = $kode->count();
        if ($count>=1 && $kount>=1) {
            return redirect('produk/produk')->with('error', 'Nama Produk, Kode Barang, dan Barangnya sudah ada!');
        }
        if ($count>=1) {
            foreach ($valid as $item );

            if ($item->id != $id) {
                return redirect('produk/produk')->with('error', 'Nama Produk dan Barangnya sudah ada!');
            }
        }
        if ($kount>=1) {
            foreach ($kode as $falid);
        
            if ($falid->id != $request->id) {
                return redirect('produk/produk')->with('error', 'Kode Barangnya sudah ada!');
            }
        }
        
        DB::table('produk')->where('id', $id)
            ->update([
                'nama_produk' => $request->nama_produk,
                'kode'=> $request->kode,
                'merk'=>$request->merk,
                'harga_jual'=>$request->harga_jual,
                'harga_beli'=>$request->harga_beli,
                
            ]);
        } catch (\Throwable $th) {
            return redirect('produk/produk')->with('error', 'Mohon isi kategori');
        }
        
            return redirect('produk/produk')->with('status', 'Produk Berhasil diedit!');
    }

    public function delete($id)
    {
        DB::table('barang_masuk')->where('produk_id', $id)->delete();
        DB::table('pengeluaran')->where('produk_id', $id)->delete();
        DB::table('produk')->where('id', $id)->delete();
        return redirect('produk/produk')->with('status', 'Produk beserta Barang Masuk dan Pengeluaran yang bersangkutan Berhasil dihapus!');
    }
}
