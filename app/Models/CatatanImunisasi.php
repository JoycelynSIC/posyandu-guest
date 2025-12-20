<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatatanImunisasi extends Model
{
    protected $table = 'catatan_imunisasi';
    protected $primaryKey = 'imunisasi_id';

    protected $fillable = [
        'warga_id',
        'jenis_vaksin',
        'tanggal',
        'lokasi',
        'nakes',
        'file_name'
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }
}
