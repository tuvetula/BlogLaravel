@extends('base')

@section('title')
Les Administrateurs
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
    <h1>Administrateurs</h1>
    @if(session()->has('info'))
    <div class="alert alert-success text-center font-weight-bold">{{session('info')}}</div>
    @endif
    <div class="text-right">
        <a class="btn btn-primary" href="{{ route('backend.register') }}">{{ __('New') }}</a>
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
        @foreach($admins as $admin)
        <tr>
            <td>{{$admin->id}}</td>
            <td>{{$admin->name}}</td>
            <td>{{$admin->first_name}}</td>
            <td>{{date_format($admin->created_at,'d-m-Y')}}</td>
            <td>
                <div class="row float-right">
                    <div class="mx-2">
                        <a class="btn btn-sm btn-primary" href="{{ route('backend.admins.show' , $admin->id) }}">{{ __('See') }}</a>
                    </div>
                    <div class="mx-2">
                        <a class="btn btn-sm btn-warning" href="{{ route('backend.admins.edit' , $admin->id) }}">{{ __('Edit') }}</a>
                    </div>
                    <div class="mx-2">
                        <form action="{{route('backend.admins.destroy' , $admin->id)}}" method="POST">
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
        {{$admins->links()}}
    </div>
</div>
@endsection

