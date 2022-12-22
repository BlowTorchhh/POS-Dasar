<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
   
    protected $table = 'kategori';
    protected $primaryKey = "id";
    protected $fillable = [
        'id','kategori'
    ];
    public function produk(){
        return $this->hasMany(produk::class);
    }
}
