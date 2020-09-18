<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = factory(App\Product::class, 10)->create();

        foreach ($products as $product) {
            $stocks = factory(App\Stock::class, 35)->make();
            foreach ($stocks as $stock) {
                repeat: try {
                    $product->stocks()->save($stock);
                } catch (\Illuminate\Database\QueryException $e) {
                    $stock = factory(App\Stock::class)->make();
                    goto repeat;
                }
            }
        }
    }
}
