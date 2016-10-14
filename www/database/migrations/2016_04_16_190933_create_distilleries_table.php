<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistilleriesTable extends Migration
{
    const MODEL = 'distillery';
    const TABLE = 'distilleries';
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
            $table->string('name');
            $table->text('description');
            $table->decimal('latitude', 9, 6);
            $table->decimal('longitude', 9, 6);

            // Meta Data
            $table->timestamps();
        });

        // Foreign Key
        Schema::table(self::TABLE, function(Blueprint $table)
        {
            $table->unsignedInteger(CreateRegionsTable::FOREIGN_KEY);
            $table->foreign(CreateRegionsTable::FOREIGN_KEY)
                ->references(CreateRegionsTable::PRIMARY_KEY)
                ->on(CreateRegionsTable::TABLE)
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
