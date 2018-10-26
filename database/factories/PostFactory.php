<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(6),
        'content' => $faker->paragraph(10),
        'user_id' => 2,
    ];
});
