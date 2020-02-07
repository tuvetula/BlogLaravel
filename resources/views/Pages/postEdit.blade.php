@extends('base')
@section('title')
    Editer
    @endsection

@section('body')
    <div class="container my-3 text-center" xmlns="http://www.w3.org/1999/html">
        <h1>{{ __('Modify') }}</h1>
        <form method="POST" action="{{ route('posts.update', $post->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group text-left font-weight-bold">
                <label for="title">Titre</label>
                <input type="text" class="form-control  @error('title') is-invalid @enderror" name="title" id="title" placeholder="Titre" value="{{ old('title', $post->title) }}">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group text-left font-weight-bold">
                <label for="post">Message</label>
                <textarea class="form-control"  rows="5" @error('post') is-invalid @enderror" name="post" id="post" placeholder="Votre post">{{ old('post', $post->post)}}</textarea>
                @error('post')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group text-left">
                <label for="tag" class="font-weight-bold">Tag</label>
                <div class="container row">
                    <input list=listTagsChoices type="text" class="form-control col-md-3" id="tag" placeholder="Saisir un tag">
                    @if(!empty($tags))
                        <datalist id="listTagsChoices">
                            @foreach($tags as $tag)
                                <option value="{{ $tag->name }}"></option>
                            @endforeach
                        </datalist>
                    @endif
                    <button type="button" id="buttonAddTags" class="btn btn-primary col-md-1 ml-2">Ajouter</button>
                </div>
                <div class="container">
                    <div id="listTags" class="row p-3">
                    @foreach($post->tags as $tag)
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
            <button type="submit" class="btn btn-primary">{{ __('Modify') }}</button>
        </form>
    </div>
    @endsection

@section('js')
    <script src="{{ asset('js/tag.js') }}"></script>
@endsection
