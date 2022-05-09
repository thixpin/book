<?php namespace Thixpin\Book\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateRatingsTable Migration
 */
class CreateRatingsTable extends Migration
{
    public function up()
    {
        Schema::create('thixpin_book_ratings', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('rating')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('thixpin_book_ratings');
    }
}
