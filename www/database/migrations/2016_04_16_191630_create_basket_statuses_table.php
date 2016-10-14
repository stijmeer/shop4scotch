<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasketStatusesTable extends Migration
{
    const MODEL = 'basket_status';
    const TABLE = self::MODEL.'es';
    const PRIMARY_KEY = 'id';
    const FOREIGN_KEY = self::MODEL.'_'.self::PRIMARY_KEY;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            // Primary Key
            $table->increments(self::PRIMARY_KEY);
            
            // Data
            $table->string('name');
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(self::TABLE);
    }
}
