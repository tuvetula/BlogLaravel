@extends('base')

@section('title')
    Voir
    @endsection

@section('body')
    <div class="container my-3">
        @if(session()->has('info'))
            <div class="alert alert-success text-center font-weight-bold">{{session('info')}}</div>
        @endif
        <div class="card mt-3">
            <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <p>Auteur:
                                @if(get_class($post->postable) == 'App\Models\Admin')
                                    <span>{{ __('Administrator') }}
                                        @endif{{ $post->postable->first_name }}</span></p>
                        </div>
                        <div class="col-md-4">
                            <h3 class="font-weight-bold text-center"> {{ $post->title }} </h3>
                        </div>
                        <div class="col-md-4">
                            <p class="text-right"> {{ date_format($post->updated_at , 'd-m-Y') }}</p>
                        </div>
                    </div>
            </div>
            <div class="card-content my-3 px-3">
                <p>{{ $post->post }}</p>
            </div>
            <div class="card-footer py-3">
                <div class="row">
                    <div class="col-md-9">
                        @foreach($tags as $tag)
                            <span class="border border-primary rounded-pill p-2 bg-primary text-light align-middle">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                    @if($session_id == $post->user_id && $post->postable_type == $session_model)
                        <div class="col-md-3">
                            <div class="row float-right mr-1">
                                <a class="btn btn-sm btn-warning ml-2" href="{{ route('posts.edit' , $post->id) }}">{{ __('Edit') }}</a>
                                <form action="{{route('posts.destroy' , $post->id)}}" method="POST" onsubmit="confirm('Êtes-vous sûr de vouloir supprimer ce post?')">
                                    @csrf
                                    @method('DELETE')
                                <button class="btn btn-sm btn-danger ml-2" type="submit">{{ __('Delete') }}</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
            <section class="card text-center my-3">
            <div class="card-header">
                <h4 class="font-weight-bold">Commentaires</h4>
            </div>
            <div class="card-content container mb-3">
                @foreach($comments as $comment)
                    <div class="container my-3">
                        <div class="row">
                            <p class="text-left font-weight-bold">@if($comment->commentable_type == 'App\Models\Admin') <span class="font-italic">{{ __('Administrator') }}</span> @endif{{ $comment->commentable->first_name }}, le {{ date('d-m-Y',strtotime($comment->updated_at)) }} à {{ date( 'H:i',strtotime($comment->updated_at)) }}</p>
                        </div>
                        <div class="row">
                            <div class="col-md-9 px-0">
                                <p class="text-left">{{$comment->comment}}</p>
                            </div>
                            <div class="col-md-3 px-0">
                                <div class="row float-right mr-1">
                                @if($session_id == $comment->commentable->id && $comment->commentable_type == $session_model)
                                    <a class="btn btn-sm btn-warning ml-2" href="{{ route('comment.edit' , $comment->id) }}">{{ __('Edit') }}</a>
                                @endif
                                @if($session_id == $comment->commentable->id && $comment->commentable_type == $session_model || $session_model == 'App\Models\Admin')
                                    <form action="{{route('comment.destroy' , $comment->id)}}" method="POST" class="justify-content-end" onsubmit="confirm('Êtes-vous sûr de vouloir supprimer votre commentaire?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger ml-2" type="submit">{{ __('Delete') }}</button>
                                    </form>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($comment->tags as $tag)
                                <span class="border border-primary rounded-pill p-2 bg-primary text-light align-middle mr-1">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                <form class="bg-light p-3" action="{{ route('comment.store', $post->id) }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{$post->id}}" name="post_id">
                    <div class="form-group my-3">
                        <textarea placeholder="Ajouter un commentaire..." class="form-control @error('comment') is-invalid @enderror" name="comment" id="" cols="60" rows="5">{{ old('comment') }}</textarea>
                        @error('comment')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group text-left">
                        <label for="tag" class="font-weight-bold">Tag</label>
                        <div class="container row">
                            <input list=listTagsChoices type="text" class="form-control col-md-3" id="tag" placeholder="Saisir un tag">
                            @if(!empty($tags))
                                <datalist id="listTagsChoices">
                                    @foreach($tagsChoice as $tag)
                                        <option value="{{ $tag->name }}"></option>
                                    @endforeach
                                </datalist>
                            @endif
                            <div class="col-sm-1 col-md-2">
                            <button type="button" id="buttonAddTags" class="btn btn-primary">Ajouter</button>
                            </div>
                        </div>
                        <div class="container py-3">
                            <div id="listTags" class="row px-3">

                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="tags" id="hiddenTags">
                    <input type="hidden" name="tagsToDelete" id="hiddenTagsToDelete">
                    <button class="btn btn-primary" type="submit">Ajouter un commentaire</button>
                </form>
            </div>
        </section>
    </div>
    @endsection

@section('js')
    <script src="{{ asset('js/tag.js') }}"></script>
@endsection
