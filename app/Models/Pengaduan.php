<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';
    protected $primaryKey = 'id_pengaduan';

    protected $fillable = [
        'id_user',
        'judul',
        'isi',
        'tanggal',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'id_pengaduan');
    }

    // Scopes
    public function scopeMenunggu($query)
    {
        return $query->where('status', 'Menunggu');
    }

    public function scopeDiproses($query)
    {
        return $query->where('status', 'Diproses');
    }

    public function scopeSelesai($query)
    {
        return $query->where('status', 'Selesai');
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('id_user', $userId);
    }
}