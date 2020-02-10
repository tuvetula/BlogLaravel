@extends('base')

@section('title')
    {{ __('Users') }}
@endsection

@section('css')
    <style>
        .pagination{
            justify-content: center;
        }
        #avatar{
            max-width: 100px;
            max-height: 100px;
        }
    </style>
@endsection

@section('body')
    <div class="container py-3">
        <div class="card">
            <div class="card-header">
                <p class="font-weight-bold">{{ $user->name }} {{ $user->first_name }}</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 text-center">
                    @if(!empty($user->avatar))
                            <img src="{{ url('storage/'.$user->avatar)}}" alt="avatar" id="avatar">
                        @else
                            <img src="{{ url('storage/avatars/iconePhoto128.png') }}" alt="avatar" id="avatar">
                        @endif
                    </div>
                <div class="col-md-10">
                    <label for="email" class="font-weight-bold">{{ __('E-Mail Address') }}</label>
                    <p>{{ $user->email }}</p>
                    <label for="createdAt" class="font-weight-bold">Date de création</label>
                    <p>{{ date_format($user->created_at , 'd-M-Y à H:i:s') }}</p>
                    <label for="countPosts" class="font-weight-bold">Nombre de posts</label>
                    <p>{{ count($user->userPosts) }}</p>
                    <label for="countComments" class="font-weight-bold">Nombre de commentaires</label>
                    <p>{{ count($user->userComments) }}</p>
                </div>
                </div>
            </div>
        </div>
        <div class="container text-center py-3">
            <a href="{{ route('backend.users.index') }}" class="btn btn-primary">{{ __('Back') }}</a>
        </div>
    </div>
    @endsection
