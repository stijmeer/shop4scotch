<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasketProductTable extends Migration
{
    const TABLE = CreateBasketsTable::MODEL.'_'.CreateProductsTable::MODEL;
    const PRIMARY_KEY = [
        CreateBasketsTable::FOREIGN_KEY,
        CreateProductsTable::FOREIGN_KEY,
    ];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basket_product', function (Blueprint $table) {
            // Primary Key (Composite Key)
            foreach (self::PRIMARY_KEY as $column) {
                $table->unsignedInteger($column);
            }
            $table->primary(self::PRIMARY_KEY);

            // Data
            $table->integer('amount');

            // Meta Data
            $table->timestamps();
        });

        // Foreign Keys
        Schema::table(self::TABLE, function(Blueprint $table)
        {
            $table->foreign(CreateBasketsTable::FOREIGN_KEY)
                ->references(CreateBasketsTable::PRIMARY_KEY)
                ->on(CreateBasketsTable::TABLE)
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
        Schema::drop('basket_product');
    }
}
