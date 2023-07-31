<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengeluaran extends Model
{
    use HasFactory;
    use HasFormatRupiah;
    protected $table = 'pengeluaran';
    protected $primaryKey = "id";
    protected $fillable = [
        'id','tanggal','produk_id','jumlah_keluar','harga','total'
    ];
    public function produk(){
        return $this->belongsTo(produk::class);
    }
    public function kategori(){
        return $this->belongsTo(kategori::class);
    }
    public function laporan_harian(){
        return $this->belongsTo(laporan_harian::class);
    }
}
