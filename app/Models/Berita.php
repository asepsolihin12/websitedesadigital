<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';
    protected $primaryKey = 'id_berita';

    protected $fillable = [
        'judul',
        'isi',
        'tanggal',
        'penulis',
        'gambar',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // Scopes
    public function scopeTerbaru($query)
    {
        return $query->orderBy('tanggal', 'desc');
    }

    public function scopeByPenulis($query, $penulis)
    {
        return $query->where('penulis', $penulis);
    }
}