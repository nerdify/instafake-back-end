<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domain\Comments\Models\Comment;
use App\Domain\Posts\Models\Post;
use App\Domain\Users\Models\User;
use Faker\Generator as Faker;

$factory->define(
    Comment::class,
    function (Faker $faker) {
        return [
            'parent_id' => $faker->randomElement([null, factory(Comment::class), null]),
            'post_id' => $faker->randomElement(Post::pluck('id')) ?? factory(Post::class),
            'user_id' => $faker->randomElement(User::pluck('id')) ?? factory(User::class),

            'is_root' => false,
            'text' => $faker->paragraph,
        ];
    }
);
