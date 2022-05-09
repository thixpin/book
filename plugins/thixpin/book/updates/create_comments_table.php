<?php namespace Thixpin\Book\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateCommentsTable Migration
 */
class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('thixpin_book_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id')->unsigned();
            $table->string('name');
            $table->string('email')->nullable();
            $table->text('comment');
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('thixpin_book_comments');
    }
}
