<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxesTable extends Migration
{
    const MODEL = 'tax';
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
            $table->string('title');
            $table->string('description');
            $table->unsignedTinyInteger('priority');
            $table->decimal('rate', 5, 4);
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
