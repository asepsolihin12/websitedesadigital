<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $table = 'contact_us';
    protected $primaryKey = 'id_contact';

    protected $fillable = [
        'nama',
        'email',
        'pesan',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // Scopes
    public function scopeTerbaru($query)
    {
        return $query->orderBy('tanggal', 'desc');
    }
}