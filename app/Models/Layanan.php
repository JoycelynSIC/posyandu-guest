<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanan';
    protected $primaryKey = 'layanan_id';

    protected $fillable = [
        'jadwal_id',
        'warga_id',
        'berat',
        'tinggi',
        'vitamin',
        'konseling',
    ];

    // RELASI KE JADWAL
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id', 'jadwal_id');
    }

    // RELASI KE WARGA
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    
}
