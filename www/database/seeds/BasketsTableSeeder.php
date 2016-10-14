<?php

use Illuminate\Database\Seeder;
use App\Models\Basket;
use App\Models\Product;
use Carbon\Carbon;

class BasketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();
        factory(Basket::class, 75)->create()
            ->each( function ($basket) use ($products) {
                $amount = rand(DatabaseSeeder::AMOUNT['MIN'], DatabaseSeeder::AMOUNT['SOME']);
                $basket->products()->attach($products->random($amount), [
                    'amount' => rand(1, 5),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            });
    }
}
