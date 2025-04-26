<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'supplier';

    protected $fillable = [
        'nama',
        'alamat',
        'telepon',
    ];

    public function obat()
    {
        return $this->hasMany(Obat::class, 'supplier_id');
    }

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'supplier_id');
    }
}
