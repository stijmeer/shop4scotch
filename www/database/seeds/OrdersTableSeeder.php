<?php

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();

        factory (Order::class, 750)->create()
            ->each(function ($order) use ($products) {
                $amount = rand(DatabaseSeeder::AMOUNT['MIN'], DatabaseSeeder::AMOUNT['SOME']);
                $order->products()->attach($products->random($amount), [
                    'quantity' =>rand(1,5),
                    'price' => Product::find(rand(1,100))->select('price')->get(),
                    'price_discount' => Product::find(rand(1,100))->select('price')->get(),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            });
    }
}
