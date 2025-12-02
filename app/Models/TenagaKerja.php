<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenagaKerja extends Model
{
    use HasFactory;

    protected $table = 'tenaga_kerja';
    protected $primaryKey = 'id_tenaga';

    protected $fillable = [
        'nama',
        'jabatan',
        'bio',
        'kontak',
    ];

    // Scopes
    public function scopeByJabatan($query, $jabatan)
    {
        return $query->where('jabatan', $jabatan);
    }
}