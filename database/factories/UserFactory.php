<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domain\Users\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(
    User::class,
    function (Faker $faker) {
        return [
            'email' => $faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'password' => bcrypt('secret'),
            'remember_token' => Str::random(10),
            'username' => $faker->unique()->userName,
        ];
    }
);
