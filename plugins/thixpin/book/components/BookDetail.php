<?php namespace Thixpin\Book\Components;

use Thixpin\Book\Models\Book;
use Cms\Classes\ComponentBase;

/**
 * BookDetail Component
 */
class BookDetail extends ComponentBase
{
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
        $this->page['book'] = $this->book();
    }

    protected function book()
    {
        // die($this->param('slug'));
        return Book::where('slug',  $this->param('slug'))->first();
    }
}
