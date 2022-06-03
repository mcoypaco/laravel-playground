<?php

namespace App\Repositories\Support;

trait Resource
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function all()
    {
        return $this->setResponseCollection(
            $this->model->cursor()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return mixed
     */
    public function create()
    {
        return $this->setResponseResource(
            $this->model->create(
                request()->all()
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return mixed
     */
    public function update($id)
    {
        $model = $this->model->findOrFail($id);

        $model->update(
            request()->all()
        );

        return $this->setResponseResource($model);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return mixed
     */
    public function find($id, bool $findOrFail = true)
    {
        return $this->setResponseResource(
            $findOrFail ? $this->model->findOrFail($id) : $this->model->find($id)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $model = $this->model->findOrFail($id);

        $model->delete();

        return 1;
    }
}
