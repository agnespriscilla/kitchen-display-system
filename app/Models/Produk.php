<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    public $timestamps = true;

    protected $fillable = [
        'nama',
        'kategori',
        'slug',
        'deskripsi',
        'foto',
        'keygaleri',
        'bagian_id',
        'created_at',
        'updated_at',
    ];

    public function bagian()
    {
        return $this->belongsTo(Bagian::class, 'bagian_id');
    }
}
