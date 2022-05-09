<?php namespace Thixpin\Book\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateChaptersTable Migration
 */
class CreateChaptersTable extends Migration
{
    public function up()
    {
        Schema::create('thixpin_book_chapters', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id')->unsigned();
            $table->string('title');
            $table->string('slug')->unique()->nullable();
            $table->text('description')->nullable();
            $table->integer('number')->default(1);
            $table->integer('pages_count')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('thixpin_book_chapters');
    }
}
