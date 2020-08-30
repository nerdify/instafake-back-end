<?php

use App\Domain\Comments\Models\Comment;
use App\Domain\Posts\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        factory(Post::class, 8)->create()->each(function ($post) {
            factory(Comment::class)->create([
                'is_root' => true,
                'post_id' => $post->id,
            ]);
        });
    }
}
