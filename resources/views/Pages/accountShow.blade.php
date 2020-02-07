@extends('base');

@section('title')
    {{ __('My account') }}
    @endsection

@section('css')
    <style>
        #avatar{
            max-width: 100px;
            max-height: 100px;
        }
    </style>
@section('body')
    <div class="container my-3">
        @if(session()->has('info'))
            <div class="alert alert-success text-center font-weight-bold">{{session('info')}}</div>
        @endif
        <div class="card">
            <div class="card-header text-center">
                <h3>Informations personnelles</h3>
            </div>
            <div class="card-body row">
                <div class="card-img col-md-2 text-center">
                    @if(!empty($user->avatar))
                    <img src="{{ url('storage/'.$user->avatar)}}" alt="avatar" id="avatar">
                        @else
                        <img src="{{ url('storage/avatars/iconePhoto128.png') }}" alt="avatar" id="avatar">
                        @endif
                </div>
                <div class="col-md-10">
                    <p><span class="font-weight-bold">{{ __('Name') }}</span>: {{ $user->name }}</p>
                    <p><span class="font-weight-bold">{{ __('First_name') }}</span>: {{ $user->first_name }}</p>
                    <p><span class="font-weight-bold">{{ __('E-Mail Address') }}</span>: {{ $user->email }}</p>

                </div>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('account.edit', $user->id) }}">
                    <button class="btn btn-primary">Modifier</button></a>
            </div>
        </div>
        <div class="card my-3">
            <div class="card-header text-center">
                <h3>Vos posts & commentaires</h3>
            </div>
            @if (!empty($posts[0]))
                @foreach($posts as $post)
                <div class="card-body">
                    <div class="jumbotron my-1 py-4">
                        <div class="container row justify-content-between p-0">
                            <p> <span class="font-weight-bold ">Titre: </span> {{ $post->title }}</p>
                            <p> <span class="font-weight-bold ">Date de dernière modification: </span> {{ date_format($post->updated_at , 'd-m-Y à H:i:s') }}</p>
                        </div>
                        <div class="container row justify-content-center py-3 mb-3 bg-light">
                            <p class="m-0"> {{ $post->post }}</p>
                        </div>
                        @foreach($post->comments as $comment)
                            <div class="container row p-0">
                                <span class="font-weight-bold">Commentaire de {{ $comment->commentable->first_name }}: </span><p class="mx-3"> {{ $comment->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            @else
                <p class="text-center my-3">Aucun post à afficher</p>
            @endif
        </div>
    </div>

    @endsection
