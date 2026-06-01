<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $table = 'website';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'deskripsi',
        'keyword',
        'alamat',
        'telepon',
        'email',
        'facebook',
        'instagram',
        'wa',
        'shopee',
        'tokped',
        'gmaps',
        'jambuka',
        'icon',
        'logo'
    ];
}
