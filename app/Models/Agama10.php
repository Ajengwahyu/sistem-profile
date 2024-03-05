<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agama10 extends Model
{
    use HasFactory;
    public function detailData() {
        return $this->hasMany(DetailData10::class);
    }

    protected $fillable = [
        'namaagama'
    ];
}
