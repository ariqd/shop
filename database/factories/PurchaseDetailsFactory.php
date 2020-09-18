<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Purchase_detail;
use App\Stock;
use Faker\Generator as Faker;

$factory->define(Purchase_detail::class, function (Faker $faker) {
    $stock = $faker->randomElement(Stock::with('product')->get());
    $randomQty = $faker->numberBetween(1, 10);

    return [
        'inventory_id' => $stock->id,
        'qty' => $randomQty,
        'status' => 'OK',
        'subtotal' => $stock->product->price * $randomQty
    ];
});
