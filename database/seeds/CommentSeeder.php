<?php

use App\Domain\Comments\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
        factory(Comment::class, 10)->create();
    }
}
