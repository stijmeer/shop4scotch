<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasketsTable extends Migration
{
    const MODEL = 'basket';
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

            // Meta Data
            $table->timestamps();
            $table->softDeletes();
        });

        // Foreign Key
        Schema::table(self::TABLE, function(Blueprint $table)
        {
            $table->unsignedInteger(CreateUsersTable::FOREIGN_KEY);
            $table->foreign(CreateUsersTable::FOREIGN_KEY)
                ->references(CreateUsersTable::PRIMARY_KEY)
                ->on(CreateUsersTable::TABLE)
                ->onDelete('cascade');
            $table->unsignedInteger(CreateBasketStatusesTable::FOREIGN_KEY);
            $table->foreign(CreateBasketStatusesTable::FOREIGN_KEY)
                ->references(CreateBasketStatusesTable::PRIMARY_KEY)
                ->on(CreateBasketStatusesTable::TABLE)
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
