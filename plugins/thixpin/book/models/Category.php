<?php namespace Thixpin\Book\Models;

use Model;

/**
 * Category Model
 */
class Category extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table associated with the model
     */
    public $table = 'thixpin_book_categories';

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
        'name' => 'required|unique:thixpin_book_categories',
        'slug' => [ 'required', 'unique:thixpin_book_categories', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i' ],
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
    public $hasOne = [
        'books_count' => [ 'Thixpin\Book\Models\BooksCategory', 'table' => 'thixpin_book_books_categories', 'key' => 'category_id', 'otherKey' => 'id', 'count' => true],
    ];
    public $hasMany = [
        'books' => ['Thixpin\Book\Models\Book', 'table' => 'thixpin_book_books_categories', 'order' => 'title'],
    ];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function beforeCreate()
    {
        $this->slug = str_slug($this->name);
    }
}
