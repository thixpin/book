<?php namespace Thixpin\Book\Components;

use Thixpin\Book\Models\Book;
use Cms\Classes\ComponentBase;

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
        return [];
    }

    public function onRun()
    {
        $this->page['books'] = $this->listBooks();
    }

    protected function listBooks()
    {
        return Book::all();
    }
}
