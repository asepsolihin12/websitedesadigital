<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function penduduk()
    {
        return $this->hasOne(Penduduk::class, 'id_user');
    }

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'id_user');
    }

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'id_user');
    }

    public function suratOnline()
    {
        return $this->hasMany(SuratOnline::class, 'id_user');
    }

    // Helper Methods
    public function isAdmin(): bool
    {
        return $this->role === 'Admin';
    }

    public function isPetugas(): bool
    {
        return $this->role === 'Petugas';
    }

    public function isWarga(): bool
    {
        return $this->role === 'Warga';
    }

    // Scopes
    public function scopeAdmin($query)
    {
        return $query->where('role', 'Admin');
    }

    public function scopePetugas($query)
    {
        return $query->where('role', 'Petugas');
    }

    public function scopeWarga($query)
    {
        return $query->where('role', 'Warga');
    }
}