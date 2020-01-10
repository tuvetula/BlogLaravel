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
    <div class="container text-center my-3">
        <h1>Posts</h1>
        @if(session()->has('info'))
            <div class="alert alert-success">{{session('info')}}</div>
        @endif
        <div class="text-right">
            <a class="btn btn-primary" href="{{ route('posts.create') }}">{{ __('New') }}</a>
        </div>
        @foreach($posts as $post)
            <div class="card my-3 border-dark">
                <div class="card-header">
                    <span class="font-weight-bold">{{$post->title}}</span><span class="float-right">{{$post->author}}</span>

                </div>
                <div class="card-body text-left"> {{$post->post}}</div>
                <div class="card-footer">
                    <div class="row justify-content-between">
                            <div class="col-md-4">
                                @if($session_id == $post->userId)
                                <a class="btn btn-warning" href="{{ route('posts.edit' , $post->id) }}">{{ __('Edit') }}</a>
                                @endif
                            </div>
                        <div class="col-md-4">
                            <form action="{{route('posts.destroy' , $post->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">{{ __('Delete') }}</button>
                            </form>
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
