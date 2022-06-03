<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\User;
use Facades\App\Repositories\Contracts\PostRepositoryInterface as PostRepository;

class UserRepository extends Repository implements UserRepositoryInterface
{
    /**
     * Rules for search.
     *
     * @var array
     */
    protected $searchRules = [
        'id' => 'numeric',
        'name' => 'string',
        'email' => 'string',
        'email_verified_at' => 'date'
    ];

    /**
     * Create the repository instance.
     *
     * @param \App\User
     */
    public function __construct(User $model)
    {
        $this->model = $model;

        $this->relatedSearchRules = [
            'posts' => PostRepository::searchRules()
        ];
    }
}
