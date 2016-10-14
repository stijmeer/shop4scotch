<?php

use App\Models\Distillery;
use Illuminate\Database\Seeder;

class DistilleriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Distillery::class, DatabaseSeeder::AMOUNT['MANY'])->create();
    }
}
