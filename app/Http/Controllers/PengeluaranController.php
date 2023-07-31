<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\pengeluaran;
use App\Models\produk;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluaran = pengeluaran::with('produk','kategori')->paginate(10);
        $count = pengeluaran::with('produk','kategori')->count();
        return view('pengeluaran.data', ['pengeluaran' => $pengeluaran],compact('count'));
        //return $edulevels;
    }

    public function add()
    {
        $pro = produk::all();
        $pengeluaran = pengeluaran::with('produk');
        return view('pengeluaran.add', compact('pengeluaran','pro'));
    }

    public function addProcess(Request $request)
    {
        try {
            $produk = produk::all($produk = ['*'])->where('id', $request->produk_id);
            $valid = DB::table('pengeluaran')->where(['tanggal' => $request->tanggal , 'produk_id'=> $request->produk_id])->get();
            $count = $valid->count();
            if ($count >= 1) {
                foreach ($produk as $item);
                foreach ($valid as $barang);
                if($item->stok < $request->jumlah){
                    if($item->stok == 0){
                        return redirect('pengeluaran/add')->with('error', 'produk sudah habis');
                    }
                    return redirect('pengeluaran/add')->with('error', 'jumlah gabungan pengeluaran melebihi jumlah stok produk yang tersisa yaitu '.$item->stok);
                }
                DB::table('pengeluaran')->where('id', $barang->id)
            ->update([
                'jumlah_keluar'=>$request->jumlah + $barang->jumlah_keluar,
                'total'=>($request->jumlah + $barang->jumlah_keluar) * $item->stok,
            ]);

            DB::table('produk')->where('id', $request->produk_id)
            ->update([
            'stok' => $item->stok - ($request->jumlah + $item->jumlah_keluar),
            ]);
            return redirect('pengeluaran')->with('status', 'Pengeluaran Berhasil digabungkan!');
            }

        foreach ($produk as $item);

            if($item->stok < $request->jumlah){
                if($item->stok == 0){
                    return redirect('pengeluaran/add')->with('error', 'produk sudah habis');
                }
                return redirect('pengeluaran/add')->with('error', 'jumlah keluar melebihi jumlah stok produk yang tersisa yaitu '.$item->stok);
            }

        DB::table('pengeluaran')->insert([
            'tanggal' => $request->tanggal,
            'produk_id' => $request->produk_id,
            'jumlah_keluar' => $request->jumlah,
            'total'=>$request->jumlah * $item->harga_jual,
        ]);

        DB::table('produk')->where('id', $request->produk_id)
        ->update([
        'stok' => $item->stok - $request->jumlah,
        ]);

        } catch (\Throwable $th) {
            return redirect('pengeluaran/add')->with('error', 'Mohon Pilih Produk ');
        }
        

        return redirect('pengeluaran')->with('status', 'Pengeluaran Berhasil ditambah!');
    }

    public function edit($id)
    {
        $pro = produk::all();
        $pengeluaran = pengeluaran::with('produk')->findorfail($id);
        return view('pengeluaran.edit', compact('pengeluaran','pro'));
    }

    public function editProcess(Request $request, $id)
    {
        try {
            $produk = produk::all($produk = ['*'])->where('id', $request->produk_id);

        foreach ($produk as $item);

        if($item->stok <= ($request->jumlah - $request->old_jumlah)){
            if ($item->stok == 0) {
                return redirect('pengeluaran/edit/'.$id)->with('error', 'produk sudah habis ');
            }
            return redirect('pengeluaran/edit/'.$id)->with('error', 'jumlah hasil edit keluar melebihi jumlah stok yang tersisa yaitu '.$item->stok);
        }

        DB::table('pengeluaran')->where('id', $id)
            ->update([
            'tanggal' => $request->tanggal,
            'produk_id' => $request->produk_id,
            'jumlah_keluar' => $request->jumlah,
            'total'=>$request->jumlah * $item->stok,
            ]);

            DB::table('produk')->where('id', $request->produk_id)
            ->update([
            'stok' => $item->stok - ($request->jumlah - $request->old_jumlah),
            ]);
        } catch (\Throwable $th) {
            return redirect('pengeluaran/edit/'.$id)->with('error', 'Mohon pilih Produk!');
        }
        
            return redirect('pengeluaran')->with('status', 'Pengeluaran Berhasil diedit!');
    }

    public function delete(Request $request,$id)
    {

        $produk = produk::all($produk = ['*'])->where('id', $request->produk_id);

        foreach ($produk as $item){
            DB::table('produk')->where('id', $request->produk_id)
            ->update([
                'stok' => $item->stok + $request->jumlah,
            ]);
        
        }
        DB::table('pengeluaran')->where('id', $id)->delete();
        return redirect('pengeluaran')->with('status', 'Pengeluaran Berhasil dihapus!');
        
    }
}
