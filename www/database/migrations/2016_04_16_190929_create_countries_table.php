<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    const MODEL = 'country';
    const TABLE = 'countries';
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
            $table->string('code');
            $table->string('description')->nullable();
        });

        // Foreign Key
        Schema::table(self::TABLE, function(Blueprint $table)
        {
            $table->unsignedInteger(CreateShipmentsTable::FOREIGN_KEY);
            $table->foreign(CreateShipmentsTable::FOREIGN_KEY)
                ->references(CreateShipmentsTable::PRIMARY_KEY)
                ->on(CreateShipmentsTable::TABLE)
                ->onDelete('cascade');
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
