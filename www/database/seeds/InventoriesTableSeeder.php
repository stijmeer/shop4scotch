<?php

use Illuminate\Database\Seeder;
use App\Models\Inventory;

class InventoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Inventory::class, 1000)->create();
    }
}
