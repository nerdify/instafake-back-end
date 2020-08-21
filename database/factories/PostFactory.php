<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domain\Posts\Models\Post;
use App\Domain\Users\Models\User;
use Faker\Generator as Faker;

$factory->define(
    Post::class,
    function (Faker $faker) {
        return [
            'user_id' => $faker->randomElement(User::pluck('id')) ?? factory(User::class),

            'description' => $faker->paragraph,
        ];
    }
);
