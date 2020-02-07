<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Http\Requests\PostRequest;
use App\Models\Admin;
use App\Models\Tag;
use App\Models\User;
use App\Utils\CustomAuth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Models\Post;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Illuminate\Auth\SessionGuard;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $session_id = CustomAuth::id();
        $session_model = CustomAuth::getClass();
        $posts = Post::orderBy('id','desc')->paginate(5);
        return view('Pages/postsIndex', compact(['posts','session_id','session_model']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $author = CustomAuth::user()->first_name;
        $tags = Tag::all();
        return view(    'Pages/newPost', compact('author' , 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @param TagRequest $tagRequest
     * @return RedirectResponse
     */
    public function store(PostRequest $request, TagRequest $tagRequest)
    {
        //Enregistrement en base de données
        //Eloquent
        $post = new Post;
        $post->title = $request->title;
        $post->post = $request->post;
        $post->user_id = CustomAuth::id();
        $post->postable_type = get_class(CustomAuth::user());
        $post->postable_id = CustomAuth::id();
        $post->save();
        //Gestion Tags
        if(!empty($tagRequest->tags)){
            $tags = explode(',', $tagRequest->tags);
            foreach ($tags as $tagValue){
                $tag = new Tag;
                $tag->name = $tagValue;
                $tagExistInBdd = Tag::where('name' , '=' , $tagValue)->get();
                if($tagExistInBdd->count() == 0){
                    $post->tags()->save($tag);
                }else{
                    $post->tags()->attach($tagExistInBdd->first()->id);
                }
            }
        }

        return redirect()->route('posts.index')
            ->with('info','Votre post a été ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return View
     */
    public function show(Post $post)
    {
        $session_id = CustomAuth::id();
        $session_model = CustomAuth::getClass();
        $comments = $post->comments;
        $tags = $post->tags;
        return view('Pages/postShow', compact('post','comments', 'session_id' , 'session_model' , 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::orderBy('name')->get();
        return view('Pages/postEdit', compact('post' , 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     * @param TagRequest $tagRequest
     * @return RedirectResponse
     */
    public function update(PostRequest $request, Post $post, TagRequest $tagRequest)
    {
        $post->title = $request->title;
        $post->post = $request->post;
        $post->update();
        //Gestion Tags
        $tags = explode(',', $tagRequest->tags);
        foreach ($tags as $tagValue) {
            $tag = new Tag;
            $tag->name = $tagValue;
            $tagExistInBdd = Tag::where('name', '=', $tagValue)->get();
            if ($tagExistInBdd->count() == 0) {
                $post->tags()->save($tag);
            } else {
                $post->tags()->attach($tagExistInBdd->first()->id);
            }
        }
        return redirect()->route('posts.index')->with('info','Le post a bien été modifié dans la base de données');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //Soft Delete
        $post = Post::find($id);
        $post->delete();
        //Redirection
        return back()->with('info','Le post a bien été supprimé dans la base de données');
    }
}
