<?php

use Illuminate\Database\Seeder;
use App\Models\BasketStatus;

class Basket_StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BasketStatus::create(array(
            'name'        => 'ordered',
            'description' => 'Basket has been ordered',
        ));
        BasketStatus::create(array(
            'name'        => 'pending',
            'description' => 'Basket has not been ordered or deleted',
        ));
        BasketStatus::create(array(
            'name'        => 'deleted',
            'description' => 'All products have been deleted from this basket',
        ));
    }
}
