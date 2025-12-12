<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Kader extends Model
{
    use HasFactory;

    protected $table = 'kader_posyandu';
    protected $primaryKey = 'kader_id';

    protected $fillable = [
        'posyandu_id',
        'warga_id',
        'peran',
        'mulai_tugas',
        'akhir_tugas',
    ];

    public $timestamps = false;

    // Relasi ke Posyandu (many to one)
    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'posyandu_id', 'posyandu_id');
    }

    // Relasi ke Warga (many to one)
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    /**
     * Scope untuk filter dan search
     */
    public function scopeFilter(Builder $query, $request)
    {
        // Search global berdasarkan nama warga, peran, atau nama posyandu
        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->whereHas('warga', fn($q2) => $q2->where('nama', 'like', "%{$keyword}%"))
                  ->orWhere('peran', 'like', "%{$keyword}%")
                  ->orWhereHas('posyandu', fn($q3) => $q3->where('nama', 'like', "%{$keyword}%"));
            });
        }

        // Filter berdasarkan posyandu_id
        if ($request->filled('posyandu_id')) {
            $query->where('posyandu_id', $request->posyandu_id);
        }

        return $query;
    }
}
