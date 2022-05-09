<?php namespace Thixpin\Book\Updates;


use Db;
use Faker;
use Carbon\Carbon;
use System\Models\File;
use Thixpin\Book\Models\Tag;
use Thixpin\Book\Models\Book;
use Thixpin\Book\Models\Author;
use Thixpin\Book\Models\Artist;
use Thixpin\Book\Models\Rating;
use Thixpin\Book\Models\Chapter;
use Thixpin\Book\Models\Comment;
use Thixpin\Book\Models\Category;
use October\Rain\Database\Updates\Seeder;

class SeedAllTables extends Seeder
{

    public function run()
    {

        $faker = Faker\Factory::create();

        // Create Authors
        echo "Creating authors...\n";
        for ($i = 0; $i < 3; $i++) {
            $name = $faker->name;
            Author::create([ 'name' => $name, 'slug' => str_slug($name) ]);
        }

        // Create Artists
        echo "Creating artists...\n";
        for ($i = 0; $i < 3; $i++) {
            $name = $faker->name;
            Artist::create([ 'name' => $name, 'slug' => str_slug($name) ]);
        }

        // Create categories
        echo "Creating categories...\n";
        for ($i = 0; $i < 3; $i++) {
            $name = $faker->word;
            Category::create([ 'name' => $name, 'slug' => str_slug($name) ]);
        }

        //Create Tags
        echo "Creating tags...\n";
        for ($i=0; $i < 5; $i++) { 
            $name = $faker->word;
            Tag::create([ 'name' => $name, 'slug' => str_slug($name) ]);
        }

        // Create Books
        echo "Creating books...\n";
        for ($i=0; $i < 3; $i++) { 
            $title = $faker->sentence(6);
            $book = Book::create([
                'title' => $title,
                'slug' => str_slug($title),
                'author_id' => $faker->numberBetween(1,3),
                'artist_id' => $faker->numberBetween(1,3),
                'description' => $faker->sentence(50),
                'is_published' => true,
                'cover' => $faker->image('storage/temp/public', 200, 300),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            $first = $faker->numberBetween(1,5);
            $book->tags()->attach($first);
            $second = $faker->numberBetween(1,5);
            if ($first != $second) {
                $book->tags()->attach($second);
            }
            $third = $faker->numberBetween(1,5);
            if ($first != $third && $second != $third) {
                $book->tags()->attach($third);
            }

            $book->categories()->attach($faker->numberBetween(1,3));

            for ($j=0; $j < 3; $j++) { 
                $book->comments()->create([
                    'name' => $faker->name,
                    'email' => $faker->email,
                    'comment' => $faker->sentence(10),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }

            $book->save();

        }

        // Create Chapters
        echo "Creating chapters...\n";
        $books = Book::all();
        $imgCount = 0;
        foreach ($books as $book) {
            for ($i=0; $i < 3; $i++) { 
                $title = $faker->sentence(6);
                $chapter = Chapter::create([
                    'book_id' => $book->id,
                    'number' => $i + 1,
                    'title' => $title,
                    'slug' => str_slug($title),
                    'description' => $faker->sentence(30),
                    'cover' => $faker->image('storage/temp/public', 200, 300),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                $count = $faker->numberBetween(2,5);
                for ($j=0; $j < $count; $j++) {
                    $imgCount++;
                    echo "Creating image {$imgCount}...\n";
                    $file = new File();
                    $imageModel = $file->fromFile($faker->image('storage/temp/public', 200, 300));
                    $imageModel->save();
                    $chapter->pages()->add($imageModel);
                }
                $chapter->save();
            }
        }


    }

}