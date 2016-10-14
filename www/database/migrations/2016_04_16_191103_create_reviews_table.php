<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    const MODEL = 'review';
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
            $table->string('title');
            $table->longText('content');
            $table->tinyInteger('score');// Score op 10, weergeven op 5 sterren
            $table->integer('reads');

            // Meta Data
            $table->timestamps();
            $table->softDeletes();
        });

        // Foreign Keys
        Schema::table(self::TABLE, function(Blueprint $table)
        {
            $table->unsignedInteger(CreateUsersTable::FOREIGN_KEY);
            $table->foreign(CreateUsersTable::FOREIGN_KEY)
                ->references(CreateUsersTable::PRIMARY_KEY)
                ->on(CreateUsersTable::TABLE)
                ->onDelete('cascade');
            $table->unsignedInteger(CreateProductsTable::FOREIGN_KEY);
            $table->foreign(CreateProductsTable::FOREIGN_KEY)
                ->references(CreateProductsTable::PRIMARY_KEY)
                ->on(CreateProductsTable::TABLE)
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
