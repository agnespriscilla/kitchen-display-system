<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';
    public $timestamps = true;

    protected $fillable = [
        'email',
        'namaawal',
        'namaakhir',
        'alamat',
        'kota',
        'provinsi',
        'kodepos',
        'telepon',
        'catatan',
        'rincian',
        'created_at',
        'updated_at',
    ];
}
