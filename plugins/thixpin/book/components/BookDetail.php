<?php namespace Thixpin\Book\Components;

use Thixpin\Book\Models\Book;
use Cms\Classes\ComponentBase;

/**
 * BookDetail Component
 */
class BookDetail extends ComponentBase
{
    protected $_book;
    public function componentDetails()
    {
        return [
            'name' => 'BookDetail Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title' => 'Book Slug',
                'description' => 'The slug of the book to display',
                'default' => '{{ :slug }}',
                'type' => 'string'
            ]
        ];
    }

    public function onRun()
    {
        $this->page['book'] = $this->_book = $this->book();
        $this->page['relatedBooks'] = $this->relatedBooks();
    }

    protected function book()
    {
        // die($this->param('slug'));
        return Book::where('slug',  $this->param('slug'))->first();
    }

    protected function relatedBooks()
    {
        $size = 2;
        $book = $this->_book;
        $categoriyIds = $book->categories()->lists('id');
        $idsInSameCategory = Book::wherehas('categories', function ($query) use ($categoriyIds) {
            $query->whereIn('id', $categoriyIds);
        })->where('id', '!=', $book->id)->lists('id');

        $tagIds = $book->tags()->lists('id');
        $idsInSameTag = Book::wherehas('tags', function ($query) use ($tagIds) {
            $query->whereIn('id', $tagIds);
        })->where('id', '!=', $book->id)->lists('id');
        $idsInSameAuthor = Book::where('author_id', $book->author_id)->where('id', '!=', $book->id)->lists('id');
        $idsInSameArtist = Book::where('artist_id', $book->artist_id)->where('id', '!=', $book->id)->lists('id');

        $idsWithScore = array_count_values(array_merge($idsInSameCategory, $idsInSameTag, $idsInSameAuthor, $idsInSameArtist));
        arsort($idsWithScore);
        $take = count($idsWithScore) > $size ? $size : count($idsWithScore);
        $ids = array_keys(array_slice($idsWithScore, 0, $take, true));

        return Book::whereIn('id', $ids)->get();
    }
}
