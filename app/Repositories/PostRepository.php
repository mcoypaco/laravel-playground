<?php

namespace App\Repositories;

use App\Post;
use App\Repositories\Contracts\PostRepositoryInterface;

class PostRepository extends Repository implements PostRepositoryInterface
{
    /**
     * Rules for search.
     *
     * @var array
     */
    protected $searchRules = [
        'id' => 'numeric',
        'user_id' => 'numeric',
        'title' => 'string',
        'body' => 'string',
        'published_at' => 'date'
    ];

    /**
     * Create the repository instance.
     *
     * @param \App\Post
     */
    public function __construct(Post $model)
    {
        $this->model = $model;
    }
}
