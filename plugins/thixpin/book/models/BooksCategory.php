<?php namespace Thixpin\Book\Models;

use Model;

/**
 * BooksCategory Model
 */
class BooksCategory extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table associated with the model
     */
    public $table = 'thixpin_book_books_categories';

    public $rules = [];

}
