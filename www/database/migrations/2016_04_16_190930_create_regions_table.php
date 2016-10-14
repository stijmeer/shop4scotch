<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    const MODEL = 'region';
    const TABLE = self::MODEL.'s';
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

            //Data
            $table->string('title');
            $table->text('description');

            //Meta Data
            $table->timestamps();
        });

        //Foreign Key
        Schema::table(self::TABLE, function(Blueprint $table)
        {
            $table->unsignedInteger(CreateCountriesTable::FOREIGN_KEY);
            $table->foreign(CreateCountriesTable::FOREIGN_KEY)
                ->references(CreateCountriesTable::PRIMARY_KEY)
                ->on(CreateCountriesTable::TABLE)
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
