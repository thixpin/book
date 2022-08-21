<?php namespace Thixpin\Book;

use Backend;
use System\Classes\PluginBase;

/**
 * Book Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Book',
            'description' => 'No description provided yet...',
            'author'      => 'Thixpin',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Thixpin\Book\Components\BookList' => 'bookList',
            'Thixpin\Book\Components\BookDetail' => 'bookDetail',
            'Thixpin\Book\Components\Comments' => 'bookComments',
        ];
    }

    /**
     * Registers any backend permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'thixpin.book.books' => [  'tab' => 'Book', 'label' => 'Manage books' ],
            'thixpin.book.authors' => [  'tab' => 'Book', 'label' => 'Manage authors' ],
            'thixpin.book.artists' => [  'tab' => 'Book', 'label' => 'Manage artists' ],
            'thixpin.book.categories' => [  'tab' => 'Book', 'label' => 'Manage categories' ],
            'thixpin.book.comments' => [  'tab' => 'Book', 'label' => 'Manage comments' ],
            'thixpin.book.tags' => [  'tab' => 'Book', 'label' => 'Manage tags' ],
            'thixpin.book.chapters' => [  'tab' => 'Book', 'label' => 'Manage chapters' ],
        ];
    }

    /**
     * Registers backend navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'book' => [
                'label'       => 'Comic Box',
                'url'         => Backend::url('thixpin/book/books'),
                'icon'        => 'icon-book',
                'permissions' => ['thixpin.book.books'],
                'order'       => 500,
                'sideMenu'    => [
                    'authors' => [
                        'label'       => 'Authors',
                        'icon'        => 'icon-user',
                        'url'         => Backend::url('thixpin/book/authors'),
                        'permissions' => ['thixpin.book.authors'],
                    ],
                    'artists' => [
                        'label'       => 'Artists',
                        'icon'        => 'icon-user-secret',
                        'url'         => Backend::url('thixpin/book/artists'),
                        'permissions' => ['thixpin.book.artists'],
                    ],
                    'categories' => [
                        'label'       => 'Categories',
                        'icon'        => 'icon-sitemap',
                        'url'         => Backend::url('thixpin/book/categories'),
                        'permissions' => ['thixpin.book.categories'],
                    ],
                    'books' => [
                        'label'       => 'Books',
                        'icon'        => 'icon-book',
                        'url'         => Backend::url('thixpin/book/books'),
                        'permissions' => ['thixpin.book.books'],
                    ],
                    'comments' => [
                        'label'       => 'Comments',
                        'icon'        => 'icon-comment',
                        'url'         => Backend::url('thixpin/book/comments'),
                        'permissions' => ['thixpin.book.comments'],
                    ],
                ]
            ],
        ];
    }
}
