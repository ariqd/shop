<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => ucfirst($faker->word()),
        'code' => ucfirst($faker->randomLetter()) . '-' . $faker->randomNumber(3),
        'price' => $faker->numberBetween(100000, 800000),
        'category' => $faker->randomElement(['Hijab', 'Gamis', 'Blus', 'Rompi', 'Rok'])
    ];
});
