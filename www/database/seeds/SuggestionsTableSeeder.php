<?php

use Illuminate\Database\Seeder;
use App\Models\Suggestion;

class SuggestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Suggestion::class, DatabaseSeeder::AMOUNT['DEFAULT'])->create();
    }
}
