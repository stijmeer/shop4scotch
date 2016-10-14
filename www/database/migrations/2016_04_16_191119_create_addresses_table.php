<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateaddressesTable extends Migration
{
    const MODEL = 'address';
    const TABLE = self::MODEL.'es';
    const PRIMARY_KEY = 'id';
    const FOREIGN_KEY_1 = self::MODEL.'_'.'billing'.'_'.self::PRIMARY_KEY;
    const FOREIGN_KEY_2 = self::MODEL.'_'.'delivery'.'_'.self::PRIMARY_KEY;

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
            $table->string('street');
            $table->string('number', 8);
            $table->string('bus')->nullable();
            $table->string('postalcode');
            $table->string('city');
            $table->string('state_or_province');
            $table->string('type');

            // Meta Data

            $table->timestamps();
            $table->softDeletes();
        });

        // Foreign Key
        Schema::table(self::TABLE, function(Blueprint $table)
        {
            $table->unsignedInteger(CreateCountriesTable::FOREIGN_KEY);
            $table->foreign(CreateCountriesTable::FOREIGN_KEY)
                ->references(CreateCountriesTable::PRIMARY_KEY)
                ->on(CreateCountriesTable::TABLE)
                ->onDelete('cascade');
            $table->unsignedInteger(CreateUsersTable::FOREIGN_KEY);
            $table->foreign(CreateUsersTable::FOREIGN_KEY)
                ->references(CreateUsersTable::PRIMARY_KEY)
                ->on(CreateUsersTable::TABLE)
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
