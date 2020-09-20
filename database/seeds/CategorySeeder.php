<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Category::create([
            'name' => 'Gamis',
            'slug' => 'gamis',
        ]);

        App\Category::create([
            'name' => 'Blouse',
            'slug' => 'blouse',
        ]);

        App\Category::create([
            'name' => 'Hijab',
            'slug' => 'hijab',
        ]);
    }
}
