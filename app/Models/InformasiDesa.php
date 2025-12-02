<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiDesa extends Model
{
    use HasFactory;

    protected $table = 'informasi_desa';
    protected $primaryKey = 'id_info';

    protected $fillable = [
        'judul',
        'isi',
        'kategori',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // Scopes
    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    public function scopeTerbaru($query)
    {
        return $query->orderBy('tanggal', 'desc');
    }
}