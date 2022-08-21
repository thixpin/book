<?php namespace Thixpin\Book\Components;

use Cms\Classes\ComponentBase;

/**
 * Comments Component
 */
class Comments extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'comments Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onSubmit()
    {

        $rules = [
            'name' => 'required',
            'email' => 'email',
            'comment' => 'required|string|min:10',
            'book_id' => 'required|integer',
        ];

        $validation = \Validator::make(post(), $rules);
        if ($validation->fails()) {
            return [ 'error' => $validation->messages()->first() ];
        }

        $comment = new \Thixpin\Book\Models\Comment;
        $comment->name = post('name');
        $comment->email = post('email');
        $comment->comment = post('comment');
        $comment->book_id = post('book_id');
        $comment->save();

        return [ 'success' => true, 'data' => $comment ];
    }
}
