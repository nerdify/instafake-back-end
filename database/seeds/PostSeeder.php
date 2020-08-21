<?php

use App\Domain\Posts\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        factory(Post::class, 8)->create();
    }
}
