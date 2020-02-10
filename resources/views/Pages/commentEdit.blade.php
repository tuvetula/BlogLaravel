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
            <div class="form-group text-left">
                @include('Includes.addTags')
                <div class="container">
                    <div id="listTags" class="row p-3">
                        @foreach($comment->tags as $tag)
                            <div class="row rounded border border-primary bg-primary mr-4">
                                <p class="text-light text-center mb-1 px-2" state="here" >{{ $tag->name }}</p>
                                <span class="border-left border-dark bg-danger text-center text-light px-2" onclick="changeStateTags(event)">x</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <input type="hidden" name="tags" id="hiddenTags">
            <input type="hidden" name="tagsToDelete" id="hiddenTagsToDelete">
            <button type="submit" class="btn btn-primary">{{ __('Send') }}</button>
        </form>
    </div>
    @endsection

@section('js')
    <script src="{{ asset('js/tag.js') }}"></script>
@endsection
