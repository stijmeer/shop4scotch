<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    const MODEL = 'order';
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
            $table->string('reference', 15)->unique();
            $table->string('name_billing');
            $table->string('name_delivery');

            // Meta Data
            $table->timestamps();
            $table->softDeletes();
        });

        // Foreign Key
        Schema::table(self::TABLE, function(Blueprint $table)
        {
            $table->unsignedInteger(CreateaddressesTable::FOREIGN_KEY_1);
            $table->foreign(CreateaddressesTable::FOREIGN_KEY_1)
                ->references(CreateaddressesTable::PRIMARY_KEY)
                ->on(CreateaddressesTable::TABLE)
                ->onDelete('cascade');
            $table->unsignedInteger(CreateaddressesTable::FOREIGN_KEY_2);
            $table->foreign(CreateaddressesTable::FOREIGN_KEY_2)
                ->references(CreateaddressesTable::PRIMARY_KEY)
                ->on(CreateaddressesTable::TABLE)
                ->onDelete('cascade');
            $table->unsignedInteger(CreateUsersTable::FOREIGN_KEY);
            $table->foreign(CreateUsersTable::FOREIGN_KEY)
                ->references(CreateUsersTable::PRIMARY_KEY)
                ->on(CreateUsersTable::TABLE)
                ->onDelete('cascade');
            $table->unsignedInteger(CreateOrderStatusesTable::FOREIGN_KEY);
            $table->foreign(CreateOrderStatusesTable::FOREIGN_KEY)
                ->references(CreateOrderStatusesTable::PRIMARY_KEY)
                ->on(CreateOrderStatusesTable::TABLE)
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
