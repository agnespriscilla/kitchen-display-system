<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    protected $table = 'bagian';
    protected $guarded = [];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function meja()
    {
        return $this->hasMany(Meja::class);
    }
}
