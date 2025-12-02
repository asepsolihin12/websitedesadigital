<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus user existing (optional)
        User::where('email', 'admin@desa.local')->delete();
        User::where('email', 'petugas@desa.local')->delete();

        // Buat Admin
        User::create([
            'name' => 'Admin Desa',
            'email' => 'admin@desa.local',
            'password' => Hash::make('password123'),
            'role' => 'Admin',
        ]);

        // Buat Petugas
        User::create([
            'name' => 'Petugas Desa', 
            'email' => 'petugas@desa.local',
            'password' => Hash::make('password123'),
            'role' => 'Petugas',
        ]);

        // Buat sample Warga
        User::create([
            'name' => 'Warga Contoh',
            'email' => 'warga@desa.local',
            'password' => Hash::make('password123'),
            'role' => 'Warga',
        ]);

        $this->command->info('User admin, petugas, dan warga berhasil dibuat!');
        $this->command->info('Email: admin@desa.local / Password: password123');
        $this->command->info('Email: petugas@desa.local / Password: password123');
        $this->command->info('Email: warga@desa.local / Password: password123');
    }
}