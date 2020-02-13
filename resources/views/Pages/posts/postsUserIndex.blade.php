@extends('base')
@section('title')
    Mes posts
@endsection
@section('body')
    <div class="container">
        <div class="card my-3">
            <div class="card-header text-center">
                <h3>Mes posts & commentaires</h3>
            </div>
            @if (!empty($posts))
                @foreach($posts as $post)
                    <div class="card-body">
                        <div class="jumbotron my-1 py-4">
                            <div class="container row justify-content-between p-0">
                                <p><span class="font-weight-bold ">Titre: </span> {{ $post->title }}</p>
                                <p>
                                    <span
                                        class="font-weight-bold ">Date de dernière modification: </span> {{ date_format($post->updated_at , 'd-m-Y à H:i:s') }}
                                </p>
                            </div>
                            <div class="container row justify-content-center py-3 mb-3 bg-light">
                                <p class="m-0"> {{ $post->post }}</p>
                            </div>
                            @foreach($post->comments as $comment)
                                <div class="container row p-0">
                                    <span class="font-weight-bold">Commentaire de {{ $comment->commentable->first_name }}: </span>
                                    <p class="mx-3"> {{ $comment->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                    <div class="container pagination justify-content-center">
                        {{$posts->links()}}
                    </div>
            @else
                <p class="text-center my-3">Aucun post à afficher</p>
            @endif
        </div>
    </div>
@endsection
