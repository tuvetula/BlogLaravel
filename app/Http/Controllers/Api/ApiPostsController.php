<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiPostsController extends Controller
{
    /**
     * @var Post
     */
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Post[]|Collection
     */
    public function index()
    {
        return $this->post->orderBy('created_at' , 'DESC')->get();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $postRequest
     * @return void
     */
    public function store(PostRequest $postRequest)
    {
        $this->post->save($postRequest->all());
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Builder[]|Collection
     */
    public function show(Post $post)
    {
        return $this->post->newQuery()
            ->where('id' , $post->id )
            ->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $postRequest
     * @param Post $post
     * @return bool
     */
    public function update(PostRequest $postRequest, Post $post)
    {
        return $this->post->update($postRequest->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
