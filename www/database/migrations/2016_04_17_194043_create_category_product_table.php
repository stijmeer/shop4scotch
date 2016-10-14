<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryProductTable extends Migration
{
    const TABLE = CreateCategoriesTable::MODEL.'_'.CreateProductsTable::MODEL;
    const PRIMARY_KEY = [
        CreateCategoriesTable::FOREIGN_KEY,
        CreateProductsTable::FOREIGN_KEY,
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
        });

        // Foreign Keys
        Schema::table(self::TABLE, function(Blueprint $table)
        {
            $table->foreign(CreateCategoriesTable::FOREIGN_KEY)
                ->references(CreateCategoriesTable::PRIMARY_KEY)
                ->on(CreateCategoriesTable::TABLE)
                ->onDelete('cascade');
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
