@extends('base')

@section('title')
    Modifier un commentaire
    @endsection

@section('body')
    <div class="container text-center my-3">
        <h3>Modifier votre commentaire</h3>
        <form method="POST" action="{{ route('comment.update' , $comment->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group text-left font-weight-bold">
                <label for="comment">Commentaire</label>
                <textarea type="text"  class=" form-control @error('comment') is-invalid @enderror" name="comment" id="comment" rows="5">@if(isset($comment->comment) && !empty($comment->comment)) {{ $comment->comment }} @endif</textarea>
                @error('comment')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Send') }}</button>
        </form>
    </div>
    @endsection
