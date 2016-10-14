<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardCodesTable extends Migration
{
    const MODEL = 'card_code';
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
            $table->string('cvc_cid');
        });

//        // Foreign Keys
//        Schema::table(self::TABLE, function(Blueprint $table)
//        {
//            $table->unsignedInteger(CreateCardsTable::FOREIGN_KEY);
//            $table->foreign(CreateCardsTable::FOREIGN_KEY)
//                ->references(CreateCardsTable::PRIMARY_KEY)
//                ->on(CreateCardsTable::TABLE)
//                ->onDelete('cascade');
//        });
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
