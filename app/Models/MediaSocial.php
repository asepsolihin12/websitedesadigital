<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaSocial extends Model
{
    use HasFactory;

    protected $table = 'media_social';
    protected $primaryKey = 'id_medsos';

    protected $fillable = [
        'platform',
        'url',
        'icon',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    // Scopes
    public function scopeByPlatform($query, $platform)
    {
        return $query->where('platform', $platform);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('platform');
    }

    // Helper method untuk mendapatkan icon class
    public function getIconClassAttribute()
    {
        $iconMap = [
            'Facebook' => 'fab fa-facebook',
            'Instagram' => 'fab fa-instagram',
            'Twitter' => 'fab fa-twitter',
            'YouTube' => 'fab fa-youtube',
            'TikTok' => 'fab fa-tiktok',
            'WhatsApp' => 'fab fa-whatsapp',
            'Telegram' => 'fab fa-telegram',
        ];

        return $iconMap[$this->platform] ?? 'fas fa-share-alt';
    }
}