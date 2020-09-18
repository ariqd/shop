<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use App\Helpers\Rajaongkir;
use App\Purchase;
use Faker\Generator as Faker;

$factory->define(Purchase::class, function (Faker $faker) {
    $customer = $faker->randomElement(Customer::all());

    $courier = $faker->randomElement(['jne', 'pos', 'tiki']);

    $status = $faker->randomElement(['BELUM LUNAS', 'LUNAS', 'DIKIRIM', 'FINISH', 'CANCEL']);

    $postFields = [
        'origin' => 22, // Kota Bandung
        'destination' => $customer->city_id,
        'weight' => 1,
        'courier' => $courier,
    ];

    $rajaongkir = new Rajaongkir;

    $cost = json_decode($rajaongkir->post('cost', $postFields)->getBody());

    $service = $faker->randomElement($cost->rajaongkir->results[0]->costs);

    // $date = $faker->dateTimeBetween($startDate = '-1 year', $endDate = 'now', $timezone = null);
    $date = $faker->dateTimeBetween($startDate = '-2 weeks', $endDate = 'now', $timezone = null);

    return [
        'customer_id' => $customer->id,
        'sales_id' => $faker->randomElement([1, 2]),
        'purchase_no' => 'SO00' . $faker->numberBetween(100000, 999999),
        'courier_name' => strtoupper($courier),
        'courier_service_name' => $service ? $service->service : '-',
        'courier_fee' => $service ?  $service->cost[0]->value : 0,
        'discount' => $customer->status == 'Agen' ? 30 : 40,
        'status' => $status,
        // 'status' => 'FINISH',
        'weight' => 1,
        'total' => 0,
        'created_at' => $date,
        'updated_at' => $date,
    ];
});
