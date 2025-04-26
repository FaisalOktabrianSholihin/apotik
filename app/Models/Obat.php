<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obat';

    protected $fillable = [
        'nama',
        'stok',
        'satuan',
        'harga_beli',
        'harga_jual',
        'kategori_obat_id',
        'supplier_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriObat::class, 'kategori_obat_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function detailPembelian()
    {
        return $this->hasMany(DetailPembelian::class, 'obat_id');
    }

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'obat_id');
    }
}
