<?php namespace Thixpin\Book\Components;

use Thixpin\Book\Models\Book;
use Cms\Classes\ComponentBase;
use Thixpin\Book\Models\Author;
use Thixpin\Book\Models\Artist;

/**
 * BookList Component
 */
class BookList extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'BookList Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [
            'listBy' => [
                'title' => 'List By',
                'description' => 'Display book for a specific type',
                'default' => '{{ :listBy }}',
                'type' => 'string'
            ],
            'slug' => [
                'title' => 'Slug of type',
                'description' => 'The slug of type to display',
                'default' => '{{ :slug }}',
                'type' => 'string'
            ],
        ];
    }

    public function onRun()
    {
        $this->page['books'] = $this->listBooks();
    }

    protected function listBooks()
    {
        $listType = $this->property('listBy');
        $slug = $this->property('slug');
        $page = $_GET['page'] ?? 1;
        $perPage = $_GET['perPage'] ?? 8;

        switch ($listType) {
            case 'category':
                $books =  Book::wherehas('categories', function ($query) use ($slug) {
                    $query->where('slug', $slug);
                })->paginate($perPage, $page);
                break;
            case 'tag':
                $books =  Book::wherehas('tags', function ($query) use ($slug) {
                    $query->where('slug', $slug);
                })->paginate($perPage, $page);
                break;
            case 'author':
                $author = Author::where('slug', $slug)->first();
                $authorId = $author ? $author->id : 0;
                $books =  Book::where('author_id', $authorId)->paginate($perPage, $page);
                break;
            case 'artist':
                $artist = Artist::where('slug', $slug)->first();
                $artistId = $artist ? $artist->id : 0;
                $books =  Book::where('artist_id', $artistId)->paginate($perPage, $page);
                break;
            default:
                $books =  Book::paginate($perPage, $page);
                break;
        }
        
        return $books;
    }
}
