<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crea 10 usuarios de prueba
        User::factory(10)->create();

        // Crea un usuario específico para pruebas
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Llama al seeder de posts para crear posts de prueba
        $this->call(PostSeeder::class);
    }
}
