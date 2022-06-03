<?php

namespace App\Services;

use App\Repositories\Repository;
use App\Services\Contracts\ServiceInterface;
use App\Services\Support\RepositoryResource;

abstract class Service implements ServiceInterface
{
    use RepositoryResource;

    /**
     * Primary repository of the service.
     * 
     * @var \App\Repositories\Repository
     */
    protected $repository;

    /**
     * Create the instance of the service.
     *
     * @param \App\Repositories\Repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Repository instance of the service.
     * 
     * @return \App\Repositories\Repository
     */
    public function repository()
    {
        return $this->repository;
    }
}
