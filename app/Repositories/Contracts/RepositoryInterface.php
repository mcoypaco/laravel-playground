<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    /**
     * The repository model instance.
     *
     * @return \Illuminate\Database\Eloquent\Model;
     */
    public function model();

    /**
     * Column index for searching.
     *
     * @return array
     */
    public function searchRules();

    /**
     * Column index for searching of related models.
     *
     * @return array
     */
    public function relatedSearchRules();

    /**
     * Format the response for API collection.
     *
     * @param mixed $data
     * @return \Illuminate\Http\Response
     */
    public function setResponseCollection($data);

    /**
     * Format the response for API resource.
     *
     * @param mixed $data
     * @return \Illuminate\Http\Response
     */
    public function setResponseResource($data);

    /**
     * Set the offset request.
     *
     * @param array $offsetRequest
     */
    public function setOffset(array $offsetRequest);

    /**
     * Unset the offset request.
     *
     * @return void
     */
    public function offsetUnset();
}
