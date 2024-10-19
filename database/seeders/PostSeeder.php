<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    public function run()
    {
        // Crea 10 posts de prueba
        Post::factory()->count(10)->create();
    }
}
