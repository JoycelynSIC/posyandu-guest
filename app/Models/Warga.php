<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'warga';
    protected $primaryKey = 'warga_id';

    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'telp',
        'email',
        'foto'
    ];

    /**
     * 🔍 Filter per kolom spesifik
     */
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            // Kolom yang pakai LIKE (opsional: nama, pekerjaan)
            if (in_array($column, ['jenis_kelamin', 'agama'])) {
                if ($request->filled($column)) {
                    $query->where($column, 'LIKE', '%' . $request->input($column) . '%');
                }
            } 
            // Kolom filter biasa
            else {
                if ($request->filled($column)) {
                    $query->where($column, $request->input($column));
                }
            }
        }

        return $query;
    }

    /**
     * 🔍 Search global di beberapa kolom sekaligus
     */
    public function scopeSearch(Builder $query, $request, array $searchableColumns): Builder
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $searchableColumns) {
                foreach ($searchableColumns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }

        return $query;
    }
}
