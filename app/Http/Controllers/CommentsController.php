<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Comment;
use App\Http\Requests\CommentsRequest;
use App\Events\NewComment;
use App\Models\Tag;
use App\Utils\CustomAuth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class commentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentsRequest $request
     * @param TagRequest $tagRequest
     * @return RedirectResponse
     */
    public function store(CommentsRequest $request , TagRequest $tagRequest)
    {
        $user_id = CustomAuth::id();
        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->user_id = $user_id;
        $comment->commentable_type = CustomAuth::getClass();
        $comment->commentable_id = $user_id;
        $comment->save();
        //Gestion Tags
        $comment->tagsAttach($tagRequest);

        event(new NewComment($comment));

        return redirect()->route('posts.show' , $request->post_id)
            ->with('info','Votre commentaire a été ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param comment $comment
     * @return Factory|View
     */
    public function edit(comment $comment)
    {
        $tagsChoice = Tag::orderBy('name')->get();
        return view('Pages/comments/commentEdit' , compact('comment' , 'tagsChoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CommentsRequest $request
     * @param comment $comment
     * @param TagRequest $tagRequest
     * @return RedirectResponse
     */
    public function update(CommentsRequest $request , comment $comment , TagRequest $tagRequest)
    {
        $comment->comment = $request->comment;
        $comment->update();
        //Gestion Tags
        $comment->tagsAttach($tagRequest);
        $comment->tagsDetach($tagRequest);
        return redirect()->route('posts.show' , $comment->post_id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $comment = comment::find($id);
        foreach ($comment->tags as $tag){
            $comment->tagsDetachByTagId($tag->id);
        }
        $comment->delete();
        return back()->with('info', 'Le commentaire a bien été supprimé');
    }
}
