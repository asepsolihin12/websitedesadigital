<?php

namespace Database\Seeders;

use App\Models\MediaSocial;
use Illuminate\Database\Seeder;

class MediaSocialSeeder extends Seeder
{
    public function run(): void
    {
        $mediaSocials = [
            [
                'platform' => 'Facebook',
                'url' => 'https://facebook.com/desalangensari',
                'icon' => 'facebook',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'platform' => 'Instagram',
                'url' => 'https://instagram.com/desalangensari',
                'icon' => 'instagram',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'platform' => 'YouTube',
                'url' => 'https://youtube.com/c/desalangensari',
                'icon' => 'youtube',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'platform' => 'WhatsApp',
                'url' => 'https://wa.me/6281234567890',
                'icon' => 'whatsapp',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($mediaSocials as $mediaSocial) {
            MediaSocial::create($mediaSocial);
        }
    }
}