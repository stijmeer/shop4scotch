<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductWishlistTable extends Migration
{
    const TABLE = CreateProductsTable::MODEL.'_'.CreateWishlistsTable::MODEL;
    const PRIMARY_KEY = [
        CreateProductsTable::FOREIGN_KEY,
        CreateWishlistsTable::FOREIGN_KEY,
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            // Primary Key (Composite Key)
            foreach (self::PRIMARY_KEY as $column) {
                $table->unsignedInteger($column);
            }
            $table->primary(self::PRIMARY_KEY);

            // Meta Data
            $table->timestamps();
            $table->softDeletes();
        });

        // Foreign Keys
        Schema::table(self::TABLE, function(Blueprint $table)
        {
            $table->foreign(CreateProductsTable::FOREIGN_KEY)
                ->references(CreateProductsTable::PRIMARY_KEY)
                ->on(CreateProductsTable::TABLE)
                ->onDelete('cascade');
            $table->foreign(CreateWishlistsTable::FOREIGN_KEY)
                ->references(CreateWishlistsTable::PRIMARY_KEY)
                ->on(CreateWishlistsTable::TABLE)
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
