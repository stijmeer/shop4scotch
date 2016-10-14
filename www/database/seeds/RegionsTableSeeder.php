<?php

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Region::class, DatabaseSeeder::AMOUNT['DEFAULT'])->create();
    }
}
