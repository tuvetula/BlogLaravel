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
                @include('Includes.addTags')
                @include('Includes.showPostsTags')
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
