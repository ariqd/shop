<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Stock;
use Faker\Generator as Faker;

$factory->define(Stock::class, function (Faker $faker) {
    return [
        'size' => $faker->randomElement(['XS', 'S', 'M', 'L', 'XL']),
        'color' => $faker->randomElement(['Merah', 'Kuning', 'Hijau', 'Biru', 'Coklat', 'Hitam', 'Putih']),
        'qty' => $faker->numberBetween(10, 100)
    ];
});
