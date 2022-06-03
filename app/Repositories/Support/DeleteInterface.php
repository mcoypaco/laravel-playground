<?php

namespace App\Repositories\Support;

interface DeleteInterface
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id);
}
