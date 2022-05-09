<?php namespace Thixpin\Book\Models;

use Model;

/**
 * Chapter Model
 */
class Chapter extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table associated with the model
     */
    public $table = 'thixpin_book_chapters';

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
    public $rules = [];

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
        // 'pages_count' => [ 'System\Models\File', 'count' => true , 'key' => 'attachment_id', 'scope' => 'published'],
    ];
    public $hasMany = [];
    public $belongsTo = [
        'book' => [ 'Thixpin\Book\Models\Book', 'book_id' ],
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'cover' => ['System\Models\File', 'public' => true],
    ];
    public $attachMany = [
        'pages' => ['System\Models\File', 'public' => true],
    ];

    public function beforeSave()
    {
        $this->pages_count = $this->pages->count();
    }
}
