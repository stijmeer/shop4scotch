<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdministratorsTable extends Migration
{
    const MODEL = 'adminstrator';
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
            $table->tinyInteger('sex');
            /*
             * source: https://en.wikipedia.org/wiki/ISO/IEC_5218
             *
             * not known        0
             * male             1
             * female           2
             * not applicable   9
             */
            $table->string('name_first', 35);
            $table->string('name_second', 35);
            $table->string('name_last', 35);
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
            $table->date('birthday');
            $table->unsignedTinyInteger('clearance_level');

            // Meta data
            $table->timestamps();
            $table->softDeletes();
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
