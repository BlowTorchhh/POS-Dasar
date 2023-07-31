<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\laporan_harian;
use App\Models\pengeluaran;
use App\Models\Barangmasuk;
use App\Models\produk;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{

    public function produk_view()
    {
        
        $data = produk::paginate(10);
        return view('laporan.produk.laporan',['data'=>$data]);

    }

    public function produkPDF()
    {
        $data = produk::all();
        $pdf =  PDF::loadView('laporan.produk.pdf',compact('data'));
        $pdf->setPaper('a4', 'potrait');

        return $pdf->stream('Laporan Produk',  '.pdf');
    }

    public function masuk_view()
    {
        
        $data = Barangmasuk::paginate(10);
        return view('laporan.masuk.laporan',['data'=>$data]);

    }

    public function masukPDF(Request $request)
    {
        $data = Barangmasuk::whereBetween('tanggal_barang', [$request->awal , $request->akhir])->get();
        $awal = $request->awal;
        $akhir = $request->akhir;
        $grandtotal = $data->sum('total');
        $pdf =  PDF::loadView('laporan.masuk.pdf',compact('data','awal','akhir', 'grandtotal'));
        $pdf->setPaper('a4', 'potrait');
        
        return $pdf->stream('Laporan Barang Masuk',  '.pdf');
    }

    public function pengeluaran_view()
    {
        
        $data = pengeluaran::paginate(10);
        return view('laporan.keluar.laporan',['data'=>$data]);

    }

    public function keluarPDF(Request $request)
    {
        $data = Pengeluaran::whereBetween('tanggal', [$request->awal , $request->akhir])->get();
        return dd($data);
        $awal = $request->awal;
        $akhir = $request->akhir;
        $grandtotal = $data->sum('total');
        $pdf =  PDF::loadView('laporan.keluar.pdf',compact('data','awal','akhir','grandtotal'));
        $pdf->setPaper('a4', 'potrait');

        return $pdf->stream('Laporan Produk',  '.pdf');
    }
}
