<?php

namespace App\Services;

use App\Repositories\Contracts\PostRepositoryInterface;
use App\Services\Contracts\PostServiceInterface;

class PostService extends Service implements PostServiceInterface
{
    /**
     * Create the service instance and inject its repository.
     *
     * @param App\Repositories\Contracts\PostRepositoryInterface
     */
    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}
