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
use Illuminate\Routing\Redirector;
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
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        return view('Pages/posts/postsIndex', compact(['posts', 'session_id', 'session_model']));
    }

    /**
     * @param User $user
     * @return Factory|View
     */
    public function userPostsIndex(User $user)
    {
        $posts = $user->userPosts()->orderBy('created_at')->paginate(2 , ['*'] , 'postsPage');
        return view('Pages/posts/postsUserIndex', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $author = CustomAuth::user()->first_name;
        $tagsChoice = Tag::orderBy('name')->get();
        return view('Pages/posts/postNew', compact('author', 'tagsChoice'));
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
        $post->tagsAttach($tagRequest);
        return redirect()->route('posts.index')
            ->with('info', 'Votre post a été ajouté avec succès !');
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
        $tagsChoice = Tag::orderBy('name')->get();
        return view('Pages/posts/postShow', compact('post', 'session_id', 'session_model', 'tagsChoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Factory|View
     */
    public function edit(Post $post)
    {
        $tagsChoice = Tag::orderBy('name')->get();
        return view('Pages/posts/postEdit', compact('post', 'tagsChoice'));
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
        //On ajoute les tags Tags
        $post->tagsAttach($tagRequest);
        //On efface les relations tags à supprimer
        $post->tagsDetach($tagRequest);
        return redirect()->route('posts.index')->with('info', 'Le post a bien été modifié dans la base de données');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        //Soft Delete
        $post = Post::find($id);
        //On supprime tous les commentaires liés au post
        foreach ($post->comments as $comment) {
            foreach ($comment->tags as $tag) {
                $comment->tagsDetachByTagId($tag->id);
            }
            $comment->delete();
        }
        //On supprime le post
        $post->delete();
        //On supprimer les realations avec les tags du post
        foreach ($post->tags as $tag) {
            $post->tagsDetachByTagId($tag->id);
        }
        //On supprimer les realations avec les tags du commentaire lié au post

        //Redirection
        return redirect(route('posts.index'))->with('info', 'Le post a bien été supprimé dans la base de données');
    }
}
