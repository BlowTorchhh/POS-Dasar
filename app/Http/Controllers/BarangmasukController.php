<?php

namespace App\Http\Controllers;

use App\Models\Barangmasuk;
use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangmasukController extends Controller
{
    public function index()
    {  
        $data = Barangmasuk::with('kategori','produk')->paginate(10); 
        return view('Barang-masuk/Barang-masuk',['data'=>$data]);
    }

    public function add()
    {   
        $pro=produk::all();
        $data= Barangmasuk::with('produk');
        return view('Barang-masuk/Barang-masuk-add',compact('data','pro'));
    }
    public function addProcess(Request $request)
    {

        $produk = produk::all($produk = ['*'])->where('id', $request->produk_id);

        foreach ($produk as $item);

        DB::table('barang_masuk')->insert([
            'tanggal_barang'=> $request->tanggal_barang,
            'produk_id' => $request->produk_id,
            'jumlah'=>$request->jumlah,
            
          
        ]);

        DB::table('produk')->where('id', $request->produk_id)
        ->update([
        'stok' => $item->stok + $request->jumlah,
        ]);
        
        return redirect('Barang-masuk/Barang-masuk')->with('status', 'Barang-masuk Berhasil ditambah!');
    }
    public function edit($id)
    {  
         $pro=produk::all();
        $data = Barangmasuk::with('kategori','produk')->findorfail($id);
        return view('Barang-masuk/Barang-masuk-edit', compact('data','pro'));
    
    }
    public function editProcess(Request $request, $id)
    {

        $produk = produk::all($produk = ['*'])->where('id', $request->produk_id);

        foreach ($produk as $item);

        DB::table('barang_masuk')->where('id', $id)
            ->update([
                'tanggal_barang'=> $request->tanggal_barang,
                'produk_id' => $request->produk_id,
                'jumlah'=>$request->jumlah,
               
            ]);

            DB::table('produk')->where('id', $request->produk_id)
            ->update([
            'stok' => $item->stok + ($request->jumlah + $request->old_jumlah),
            ]);
            return redirect('Barang-masuk/Barang-masuk')->with('status', 'Barang masuk Berhasil diedit!');
    }
    public function delete(Request $request,$id)
    {

        $produk = produk::all($produk = ['*'])->where('id', $request->produk_id);

        foreach ($produk as $item);

        DB::table('produk')->where('id', $request->produk_id)
        ->update([
        'stok' => $item->stok - $request->jumlah,
        ]);
        
        DB::table('barang_masuk')->where('id', $id)->delete();
        return redirect('Barang-masuk/Barang-masuk')->with('status', 'Barang masuk Berhasil dihapus!');
    }

}
