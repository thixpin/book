<?php namespace Thixpin\Book\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateChapterRedingsTable Migration
 */
class CreateChapterRedingsTable extends Migration
{
    public function up()
    {
        Schema::create('thixpin_book_chapter_redings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('book_id')->unsigned();
            $table->integer('chapter_id')->unsigned();
            $table->integer('current_page')->default(0);
            $table->unique(['user_id', 'book_id', 'chapter_id'], 'thixpin_book_redings_unique');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('thixpin_book_chapter_redings');
    }
}
