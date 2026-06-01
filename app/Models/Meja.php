<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $table = 'meja';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];

    public function bagian()
    {
        return $this->belongsTo(Bagian::class, 'bagian_id', 'id');
    }
}
