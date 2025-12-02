<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    protected $table = 'penduduk';
    protected $primaryKey = 'id_penduduk';

    protected $fillable = [
        'id_user',
        'nama',
        'nik',
        'alamat',
        'jenis_kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'agama',
        'pekerjaan',
        'status_perkawinan',
        'pendidikan_terakhir',
        'no_telepon',
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Scopes
    public function scopeByNik($query, $nik)
    {
        return $query->where('nik', $nik);
    }

    public function scopeByNama($query, $nama)
    {
        return $query->where('nama', 'like', "%{$nama}%");
    }
}