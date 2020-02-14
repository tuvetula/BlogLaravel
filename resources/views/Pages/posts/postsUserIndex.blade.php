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
                        <div class="container bg-light border rounded">
                            <div class="row justify-content-between px-3 py-3">
                                <p><span class="font-weight-bold ">Titre: </span> {{ $post->title }}</p>
                                <p><span
                                        class="font-weight-bold ">Date de dernière modification: </span> {{ date_format($post->updated_at , 'd-m-Y à H:i:s') }}
                                </p>
                            </div>
                            <div class="container bg-white py-3 text-center rounded font-weight-bold border">
                                <p class="m-0"> {{ $post->post }}</p>
                            </div>
                            <div class="container py-3" style="height:180px">
                                <div class="overflow-auto mh-100">
                                    @foreach($post->comments as $comment)
                                        <span class="font-italic font-weight-light"> {{ $comment->commentable->name }} {{ $comment->commentable->first_name }}: </span>
                                        <p class=""> {{ $comment->comment }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center my-3">Aucun post à afficher</p>
            @endif
            <div class="card-footer pagination justify-content-center">
                {{$posts->links()}}
            </div>
        </div>
    </div>
@endsection
