<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    $rajaongkir = new Rajaongkir;

    $cities = $rajaongkir->get('city');

    $randomCity = $faker->randomElement($cities);

    return [
        'name' => $faker->firstName(),
        'address' => $faker->streetAddress(),
        'province_id' => $randomCity->province_id,
        'province_name' => $randomCity->province,
        'city_id' => $randomCity->city_id,
        'city_name' => $randomCity->city_name,
        'phone' => $faker->phoneNumber(),
        'status' => $faker->randomElement(['Distributor', 'Agen'])
    ];
});
