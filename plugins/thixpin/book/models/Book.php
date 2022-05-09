<?php namespace Thixpin\Book\Models;

use Model;

/**
 * Book Model
 */
class Book extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table associated with the model
     */
    public $table = 'thixpin_book_books';

    /**
     * @var array guarded attributes aren't mass assignable
     */
    protected $guarded = ['*'];

    /**
     * @var array fillable attributes are mass assignable
     */
    protected $fillable = [];

    /**
     * @var array rules for validation
     */
    public $rules = [
        'title' => 'required',
        // 'author_id' => 'required',
        // 'artist_id' => 'required',
        'slug' => [ 'required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:thixpin_book_books' ],
    ];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array jsonable attribute names that are json encoded and decoded from the database
     */
    protected $jsonable = [];

    /**
     * @var array appends attributes to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array hidden attributes removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array dates attributes that should be mutated to dates
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var array hasOne and other relations
     */
    public $hasOne = [];
    public $hasMany = [
        'comments' => 'Thixpin\Book\Models\Comment',
        'chapters' => 'Thixpin\Book\Models\Chapter',
    ];
    public $belongsTo = [
        'author' => [ 'Thixpin\Book\Models\Author' ],
        'artist' => [ 'Thixpin\Book\Models\Artist' ],
    ];
    public $belongsToMany = [
        'categories' => [ 'Thixpin\Book\Models\Category' , 'table' => 'thixpin_book_books_categories' ],
        'tags' => [ 'Thixpin\Book\Models\Tag' , 'table' => 'thixpin_book_books_tags'],
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'cover' => 'System\Models\File',
    ];
    public $attachMany = [];

    function getCategoriesOptions()
    {
        return Category::lists('name', 'id');
    }
}
