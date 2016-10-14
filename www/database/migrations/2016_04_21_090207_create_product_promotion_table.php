<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPromotionTable extends Migration
{
    /**è
     * Run the migrations.
     *
     * @return void
     */
    const TABLE = CreateProductsTable::MODEL.'_'.CreatePromotionsTable::MODEL;
    const PRIMARY_KEY = [
        CreateProductsTable::FOREIGN_KEY,
        CreatePromotionsTable::FOREIGN_KEY,
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
            $table->foreign(CreatePromotionsTable::FOREIGN_KEY)
                ->references(CreatePromotionsTable::PRIMARY_KEY)
                ->on(CreatePromotionsTable::TABLE)
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
        Schema::drop('product_promotion');
    }
}
