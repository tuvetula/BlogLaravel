@extends('base')

@section('title')
    Les posts
    @endsection

@section('css')
    <style>
        .pagination{
            justify-content: center;
        }
    </style>
    @endsection

@section('body')
    <div class="container my-3">
        <h1 class="text-center">Posts</h1>
        @if(session()->has('info'))
            <div class="alert alert-success text-center font-weight-bold">{{session('info')}}</div>
        @endif
        <div class="text-right">
            <a class="btn btn-primary" href="{{ route('posts.create') }}">{{ __('New') }}</a>
        </div>
        @foreach($posts as $post)
            <div class="card my-3 border-dark">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                                @if(get_class($post->postable) == 'App\Models\User' && !empty($post->postable->avatar))
                                    <img class="rounded-circle" src="{{ URL::asset('storage/avatarsMiniatures50x50/'.basename($post->postable->avatar)) }}" alt="avatar">
                                @else
                                    <img class="rounded-circle" src="{{ URL::asset('storage/avatarsMiniatures50x50/male-profile48.png') }}" alt="avatar">
                            @endif
                                <p class="ml-3 text-left d-inline">@if(get_class($post->postable) == 'App\Models\Admin') <span class="font-weight-bold">{{ __('Administrator') }}</span> @endif {{$post->postable->first_name }} </p>

                        </div>
                        <div class="col-md-4">
                            <p class="text-center font-weight-bold">{{$post->title}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="text-right"> {{ date_format($post->updated_at,'d-m-Y') }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-body text-left"> {{$post->post}}</div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-9">
                            @foreach($post->tags as $tag)
                                <span class="align-middle border border-primary rounded-pill p-2 bg-primary text-light">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                        <div class="col-md-3">
                            <div class="row float-right mr-1">
                                <a class="btn btn-sm btn-primary ml-2" href="{{ route('posts.show' , $post->id) }}">{{ __('See') }}</a>
                                @if((isset($session_id) && isset($session_model) && $session_model == get_class($post->postable) && $session_id == $post->postable->id))
                                    <a class="btn btn-sm btn-warning ml-2" href="{{ route('posts.edit' , $post->id) }}">{{ __('Edit') }}</a>
                                @endif
                                @if((isset($session_id) && $session_id == $post->postable->id && isset($session_model) && $session_model == $post->postable_type) || isset($session_model) && $session_model == 'App\Models\Admin')
                                    <form action="{{route('posts.destroy' , $post->id)}}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce post?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger ml-2" type="submit">{{ __('Delete') }}</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        <div class="container pagination">
            {{$posts->links()}}
        </div>
    </div>
    @endsection
