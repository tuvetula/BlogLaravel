@extends('base')
@section('title')
    Messages
@endsection
@section('body')
    <div class="container my-3">
        <h1 class="text-center mb-3">Messages</h1>
        <div class="row min-vh-100">
            @include('Pages.messages.includeListUsers')
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ $user->name }} {{ $user->first_name }}
                    </div>
                    <div class="card-body"">
                        @foreach(array_reverse($messages->items()) as $message)
                            <div class="row @if($message->from_id != $user->id) justify-content-end @endif">
                                <div class="col-md-8 @if($message->from_id != $user->id) clearfix text-right @endif">
                                    <div>
                                            <p class="{{$message->from_id != $user->id ? 'float-right bg-primary rounded-lg text-light px-3 py-2' : 'float-left bg-light rounded-lg px-3 py-2'}}">
                                                <strong>{{ $message->from_id == \App\Utils\CustomAuth::id() ? 'Moi' : $message->user->name.' '.$message->user->first_name }}</strong><br>
                                                {!! nl2br(e($message->content)) !!}
                                            </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <form method="POST" action="{{ route('messages.show' , $user->id) }}">
                            @csrf
                            <div class="form-group text-left">
                                <textarea class="form-control  @error('messageContent') is-invalid @enderror" name="messageContent" placeholder="Votre message">{{ old('messageContent') }}</textarea>
                                @error('messageContent')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
