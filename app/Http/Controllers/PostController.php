<?php

namespace App\Http\Controllers;

use App\Services\Contracts\PostServiceInterface;
use App\Http\Requests\Post\{SearchRequest, StoreRequest, UpdateRequest};

class PostController extends Controller
{
    /**
     * The service instance.
     *
     * @var \App\Services\PostServiceInterface
     */
    protected $posts;

    /**
     * Create the controller instance and resolve its service.
     * 
     * @param \App\Services\Contracts\PostServiceInterface $posts
     */
    public function __construct(PostServiceInterface $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->posts->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Post\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        return $this->posts->create();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->posts->find($id);
    }

    /**
     * Search for specific resources in the storage.
     *
     * @param  \App\Http\Requests\Post\SearchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function search(SearchRequest $request)
    {
        return $request->isMethod('post')
            ? $this->posts->advancedSearch()
            : $this->posts->simpleSearch();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Post\UpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->posts->update($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->posts->delete($id);
    }
}
