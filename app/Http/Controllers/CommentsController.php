<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\CommentsRequest;
use App\Events\NewComment;
use App\Utils\CustomAuth;
use Facade\FlareClient\Http\Response;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

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
     * @return Response
     */
    public function store(CommentsRequest $request)
    {

        $user_id = CustomAuth::id();
        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->user_id = $user_id;
        $comment->commentable_type = CustomAuth::getClass();
        $comment->commentable_id = $user_id;
        $comment->save();

        event(new NewComment($comment));


        return redirect()->route('posts.show' , $request->post_id)
            ->with('info','Votre commentaire a été ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param comment $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(comment $comment)
    {
        return view('Pages/commentEdit' , compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CommentsRequest $request
     * @param comment $comment
     * @return RedirectResponse
     */
    public function update(CommentsRequest $request , comment $comment)
    {
        $comment->comment = $request->comment;
        $comment->update();
        return redirect()->route('posts.show' , $comment->post_id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = comment::find($id);
        $comment->delete();
        return back()->with('info', 'Le commentaire a bien été supprimé');
    }
}
