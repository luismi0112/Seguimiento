<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Carlos Pérez',
            'email' => 'carlos.perez@sena.edu.co',
            'password' => Hash::make('123456'),
        ]);

        User::create([
            'name' => 'María Gómez',
            'email' => 'maria.gomez@sena.edu.co',
            'password' => Hash::make('123456'),
        ]);

        User::create([
            'name' => 'Juan Rodríguez',
            'email' => 'juan.rodriguez@sena.edu.co',
            'password' => Hash::make('123456'),
        ]);

        User::create([
            'name' => 'Ana Martínez',
            'email' => 'ana.martinez@sena.edu.co',
            'password' => Hash::make('123456'),
        ]);

        User::create([
            'name' => 'Luis Fernández',
            'email' => 'luis.fernandez@sena.edu.co',
            'password' => Hash::make('123456'),
        ]);
    }
}
