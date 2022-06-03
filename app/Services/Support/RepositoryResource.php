<?php

namespace App\Services\Support;

trait RepositoryResource
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function all()
    {
        return $this->repository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return mixed
     */
    public function create()
    {
        return $this->repository->create();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return mixed
     */
    public function update($id)
    {
        return $this->repository->update($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return mixed
     */
    public function find($id, bool $findOrFail = true)
    {
        return $this->repository->find($id, $findOrFail);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    /**
     * Search for specific resources in the database.
     *
     * @return mixed
     */
    public function simpleSearch()
    {
        return $this->repository->simpleSearch();
    }

    /**
     * Advanced search for specific resources in the database.
     *
     * @return mixed
     */
    public function advancedSearch()
    {
        return $this->repository->advancedSearch();
    }
}
