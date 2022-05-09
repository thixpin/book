<?php namespace Thixpin\Book\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateCategoriesTable Migration
 */
class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('thixpin_book_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('thixpin_book_books_categories', function (Blueprint $table) {
            $table->integer('book_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->primary(['book_id', 'category_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('thixpin_book_categories');
        Schema::dropIfExists('thixpin_book_books_categories');
    }
}
