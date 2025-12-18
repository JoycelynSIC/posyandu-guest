<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class Posyandu extends Model
{
    protected $table = 'posyandu';
    protected $primaryKey = 'posyandu_id';
    protected $fillable = [
        'nama',
        'alamat',
        'rt',
        'rw',
        'kontak',
    ];

    /**
     * Scope untuk filter dinamis berdasarkan request
     */
    public function scopeFilter(Builder $query, $request, $columns = [])
    {
        foreach ($columns as $col) {
            if ($request->filled($col)) {
                $query->where($col, 'like', '%' . $request->$col . '%');
            }
        }
        return $query;
    }

     public function scopeSearch(Builder $query, $keyword, $columns = [])
    {
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword, $columns) {
                foreach ($columns as $col) {
                    $q->orWhere($col, 'like', '%' . $keyword . '%');
                }
            });
        }
        return $query;
    }

    public function layanan()
{
    return $this->hasManyThrough(
        Layanan::class,
        Jadwal::class,
        'posyandu_id',  // FK di tabel jadwal
        'jadwal_id',    // FK di tabel layanan
        'posyandu_id',  // PK posyandu
        'jadwal_id'     // PK jadwal
    );
}

}
