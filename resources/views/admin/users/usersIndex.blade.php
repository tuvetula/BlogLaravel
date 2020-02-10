@extends('base')

@section('title')
    {{ __('Users') }}
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
        <h1>{{ __('Users') }}</h1>
        @if(session()->has('info'))
            <div class="alert alert-success text-center font-weight-bold">{{session('info')}}</div>
        @endif
        <div class="text-right">
            <a class="btn btn-primary" href="{{ route('register') }}">{{ __('New') }}</a>
        </div>
        <table class="table table-striped my-3">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">{{ __('Name') }}</th>
                <th scope="col">{{ __('First_name') }}</th>
                <th scope="col">Date de création</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->first_name}}</td>
                    <td>{{date_format($user->created_at,'d-m-Y')}}</td>
                    <td>
                        <div class="row float-right">
                            <div class="mx-2">
                                <a class="btn btn-sm btn-primary" href="{{ route('backend.users.show' , $user->id) }}">{{ __('See') }}</a>
                            </div>
                            <div class="mx-2">
                                <a class="btn btn-sm btn-warning" href="{{ route('backend.users.edit' , $user->id) }}">{{ __('Edit') }}</a>
                            </div>
                            <div class="mx-2">
                                <form action="{{route('backend.admins.destroy' , $user->id)}}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">{{ __('Delete') }}</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="container pagination">
            {{$users->links()}}
        </div>
    </div>
@endsection

