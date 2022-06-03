<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Support\{Resource, Searchable};

abstract class Repository implements RepositoryInterface
{
    use Resource, Searchable;

    /**
     * Eloquent model instance of the repository.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The offset request properties.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $offsetRequest;

    /**
     * Create the instance of the repository.
     *
     * @param \Illuminate\Database\Eloquent\Model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * The repository model instance.
     *
     * @return \Illuminate\Database\Eloquent\Model;
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * Format the response for API collection.
     *
     * @param mixed $data
     * @return \Illuminate\Http\Response
     */
    public function setResponseCollection($data)
    {
        $this->offsetUnset();

        return request()->input('formatted') && isset($this->collectionClass) ? new $this->collectionClass($data) : $data;
    }

    /**
     * Format the response for API resource.
     *
     * @param mixed $data
     * @return \Illuminate\Http\Response
     */
    public function setResponseResource($data)
    {
        $this->offsetUnset();

        return request()->input('formatted') && isset($this->resourceClass) ? new $this->resourceClass($data) : $data;
    }

    /**
     * Column index for searching.
     *
     * @return array
     */
    public function searchRules()
    {
        return isset($this->searchRules) ? $this->searchRules : [];
    }

    /**
     * Column index for searching of related models.
     *
     * @return array
     */
    public function relatedSearchRules()
    {
        return isset($this->relatedSearchRules) ? $this->relatedSearchRules : [];
    }

    /**
     * Set the offset request.
     *
     * @param array $offsetRequest
     */
    public function setOffset(array $offsetRequest)
    {
        request()->merge($offsetRequest);

        $this->offsetRequest = collect($offsetRequest)->keys();

        return $this;
    }

    /**
     * Unset the offset request.
     *
     * @return void
     */
    public function offsetUnset()
    {
        if (!$this->offsetRequest) {
            return;
        }

        $this->offsetRequest->each(function ($value) {
            request()->offsetUnset($value);
        });
    }
}
