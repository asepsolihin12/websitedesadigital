<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratOnline extends Model
{
    use HasFactory;

    protected $table = 'surat_online';
    protected $primaryKey = 'id_surat';

    protected $fillable = [
        'id_user',
        'jenis_surat',
        'tanggal_pengajuan',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Scopes
    public function scopeMenunggu($query)
    {
        return $query->where('status', 'Menunggu');
    }

    public function scopeDiterima($query)
    {
        return $query->where('status', 'Diterima');
    }

    public function scopeDitolak($query)
    {
        return $query->where('status', 'Ditolak');
    }

    public function scopeByJenisSurat($query, $jenisSurat)
    {
        return $query->where('jenis_surat', $jenisSurat);
    }
}