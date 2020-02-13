@extends('base')
@section('title')
    Messages
@endsection
@section('body')
    <div class="container">
        <h1 class="text-center p-3">Messages</h1>
        <div class="row min-vh-100">
            @include('Pages.messages.includeListUsers')
        </div>
    </div>
@endsection
