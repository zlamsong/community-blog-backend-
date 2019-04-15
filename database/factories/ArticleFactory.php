<?php

use Faker\Generator as Faker;
use App\Article;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'user_name' => $faker->name,
        'title' => $faker->text(100),
        'image' =>$faker->imageUrl($width = 640, $height = 480),
        'body' =>$faker->paragraph(20)
    ];
});
