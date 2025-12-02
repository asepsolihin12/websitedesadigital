<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sejarah extends Model
{
    use HasFactory;

    protected $table = 'sejarah';
    protected $primaryKey = 'id_sejarah';

    protected $fillable = [
        'judul',
        'isi',
        'gambar',
        'tahun',
    ];

    // Scopes
    public function scopeByTahun($query, $tahun)
    {
        return $query->where('tahun', $tahun);
    }

    public function scopeUrutTahun($query)
    {
        return $query->orderBy('tahun', 'asc');
    }
}