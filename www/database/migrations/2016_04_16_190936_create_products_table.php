<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    const MODEL = 'product';
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
            $table->string('name', 50);
            $table->text('description');
            $table->integer('stock');
            $table->decimal ('price', 8, 3);// 00.000,000 - 99.999,999
            $table->unsignedSmallInteger('volume');
            $table->tinyInteger('age');
            $table->string('color');
            $table->string('smell');
            $table->string('taste');
            $table->tinyInteger('alcohol_percentage');
            $table->tinyInteger('packaging');
            $table->string('image');
            $table->string('image_packaging')->nullable();

            // Meta Data
            $table->timestamps();
            $table->softDeletes();
        });

        // Foreign Keys
        Schema::table(self::TABLE, function(Blueprint $table)
        {
            $table->unsignedInteger(CreateSuggestionsTable::FOREIGN_KEY);
            $table->foreign(CreateSuggestionsTable::FOREIGN_KEY)
                ->references(CreateSuggestionsTable::PRIMARY_KEY)
                ->on(CreateSuggestionsTable::TABLE)
                ->onDelete('cascade');
            $table->unsignedInteger(CreateDistilleriesTable::FOREIGN_KEY);
            $table->foreign(CreateDistilleriesTable::FOREIGN_KEY)
                ->references(CreateDistilleriesTable::PRIMARY_KEY)
                ->on(CreateDistilleriesTable::TABLE)
                ->onDelete('cascade');
            $table->unsignedInteger(CreateTaxesTable::FOREIGN_KEY);
            $table->foreign(CreateTaxesTable::FOREIGN_KEY)
                ->references(CreateTaxesTable::PRIMARY_KEY)
                ->on(CreateTaxesTable::TABLE)
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
