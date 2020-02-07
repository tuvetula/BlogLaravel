@extends('base')

@section('title')
    Modifier
    @endsection

@section('body')
    <div class="container my-3">
        <h1 class="text-center">Modifier votre compte</h1>
        <form action="{{ route('account.update', $user->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label class="font-weight-bold" for="first_name">{{ __('First_name') }}</label>
                    <input type="text" value="{{ $user->first_name }}" name="first_name" id="first_name">
                </div>
                <div class="col-md-6">
                    <label class="font-weight-bold" for="name">{{ __('Name') }}</label>
                    <input type="text" value="{{ $user->name }}" name="name" id="name">
                </div>
            </div>
            <div class="row col-md-12">
                <label class="font-weight-bold" for="avatar">Avatar</label>
                <input class="mx-3" type="file" id="avatar" name="avatar" accept="image/jpeg , image/png">
            </div>
            <div class="text-center">
                <button class="btn btn-warning" type="submit">{{ __('Modify') }}</button>
            </div>
        </form>
    </div>
    @endsection

