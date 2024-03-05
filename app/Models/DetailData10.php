<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailData10 extends Model
{
    use HasFactory;
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function agama() {
        return $this->belongsTo(Agama10::class);
    }

    protected $fillable = [
        'user_id',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'agama_id',
        'foto_ktp',
        'umur',
    ];

}
