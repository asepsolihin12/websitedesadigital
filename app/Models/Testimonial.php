<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $table = 'testimonials';
    protected $primaryKey = 'id_testimoni';

    protected $fillable = [
        'nama',
        'komentar',
        'rating',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'rating' => 'integer',
    ];

    // Scopes
    public function scopeRatingTertinggi($query)
    {
        return $query->orderBy('rating', 'desc');
    }

    public function scopeTerbaru($query)
    {
        return $query->orderBy('tanggal', 'desc');
    }
}