<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    const MODEL = 'card';
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
            
            // Data
            $table->integer('number');
            $table->string('name');
            $table->date('expiration');

            // Meta Data
            $table->timestamps();
        });

        // Foreign Key
        Schema::table(self::TABLE, function(Blueprint $table)
        {
            $table->unsignedInteger(CreateUsersTable::FOREIGN_KEY);
            $table->foreign(CreateUsersTable::FOREIGN_KEY)
                ->references(CreateUsersTable::PRIMARY_KEY)
                ->on(CreateUsersTable::TABLE)
                ->onDelete('cascade');
            $table->unsignedInteger(CreateCardTypesTable::FOREIGN_KEY);
            $table->foreign(CreateCardTypesTable::FOREIGN_KEY)
                ->references(CreateCardTypesTable::PRIMARY_KEY)
                ->on(CreateCardTypesTable::TABLE)
                ->onDelete('cascade');
            $table->unsignedInteger(CreateCardCodesTable::FOREIGN_KEY);
            $table->foreign(CreateCardCodesTable::FOREIGN_KEY)
                ->references(CreateCardCodesTable::PRIMARY_KEY)
                ->on(CreateCardCodesTable::TABLE)
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
