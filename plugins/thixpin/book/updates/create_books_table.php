<?php namespace Thixpin\Book\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateBooksTable Migration
 */
class CreateBooksTable extends Migration
{
    public function up()
    {
        Schema::create('thixpin_book_books', function (Blueprint $table) {
            $table->id();
            $table->integer('author_id')->unsigned()->default(0);
            $table->integer('artist_id')->unsigned()->default(0);
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('thixpin_book_books');
    }
}
