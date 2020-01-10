<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use App\Posts;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class postsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //Querybuilder
        /*$posts = DB::table('posts')->get();
        return view('Pages/posts', compact('posts'));*/
        $session_id = Auth::user()->id;
        $posts = Posts::paginate(3);
        return view('Pages/posts', compact(['posts','session_id']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $author = Auth::user()->first_name;
        return view('Pages/newPost', compact('author'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return Response
     * @throws Exception
     */
    public function store(PostRequest $request)
    {
        //Enregistrement en base de données
        //Querybuilder
        /*DB::table('posts')->insert(
            ['title' => $request->title,
                'author' => $request->author,
                'post' => $request->post,
                'lastModification' => new \DateTime('now')]
        );*/
        //Eloquent
        $post = new \App\Posts;
        $post->title = $request->title;
        $post->author = $request->author;
        $post->post = $request->post;
        $post->userId = auth()->user()->id;
        $post->save();

        return redirect()->route('posts.index')
            ->with('info','Votre post a été ajouté avec succès !');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Posts $post
     * @return Response
     */
    public function edit(Posts $post)
    {
        return view('Pages/postEdit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Posts $post
     * @return RedirectResponse
     */
    public function update(PostRequest $request, Posts $post)
    {
        $post->title = $request->title;
        $post->author = $request->author;
        $post->post = $request->post;
        $post->update();
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
        $post = Posts::find($id);
        $post->delete();
        //Redirection
        return back()->with('info','Le post a bien été supprimé dans la base de données');
    }
}
