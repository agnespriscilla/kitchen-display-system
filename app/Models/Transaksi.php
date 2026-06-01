<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    public $timestamps = true;
    protected $guarded = [];

    public function transaksidetail()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id', 'id');
    }

    public function bagian()
    {
        return $this->belongsTo(Bagian::class, 'bagian_id', 'id');
    }
}
