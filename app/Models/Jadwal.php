<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'jadwal_id';

    protected $fillable = [
        'posyandu_id',
        'tanggal',
        'tema',
        'keterangan'
    ];

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'posyandu_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id')
            ->where('ref_table', 'jadwal')
            ->orderBy('sort_order');
    }

    // Ambil 1 poster utama
    public function poster()
    {
        return $this->media()->first();
    }
}
