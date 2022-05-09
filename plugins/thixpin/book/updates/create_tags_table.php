<?php namespace Thixpin\Book\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateTagsTable Migration
 */
class CreateTagsTable extends Migration
{
    public function up()
    {
        Schema::create('thixpin_book_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('thixpin_book_books_tags', function (Blueprint $table) {
            $table->integer('book_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->primary(['book_id', 'tag_id']);
            $table->unique(["book_id", "tag_id"], 'book_tag_unique');
        });
    }

    public function down()
    {
        Schema::table('thixpin_book_books_tags', function (Blueprint $table) {
            $table->dropUnique('book_tag_unique');
        });
        Schema::dropIfExists('thixpin_book_tags');
        Schema::dropIfExists('thixpin_book_books_tags');
    }
}
