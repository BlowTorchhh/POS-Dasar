<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangmasuk extends Model
{
    use HasFactory;
    use HasFormatRupiah;
    protected $table = 'barang_masuk';
    protected $primaryKey = "id";
    protected $fillable = [
        'id','produk_id','tanggal_barang','jumlah','total'
    ];
    public function kategori(){
        return $this->belongsTo(kategori::class);
    }
    public function produk(){
        return $this->belongsTo(produk::class);
    }
    public function laporan_harian(){
        return $this->belongsTo(laporan_harian::class);
    }
}
