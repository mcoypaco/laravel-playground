<?php

namespace App\Repositories\Support;

interface FindInterface
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return mixed
     */
    public function find($id, bool $findOrFail = true);
}
