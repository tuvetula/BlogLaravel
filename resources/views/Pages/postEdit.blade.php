@extends('base')
@section('title')
    Editer
    @endsection

@section('body')
    <div class="container my-3 text-center">
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
                <label for="author"">Auteur</label>
                <input type="text" class="form-control  @error('author') is-invalid @enderror" name="author" id="author" placeholder="Auteur" value="{{ old('author', $post->author) }}">
                @error('author')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group text-left font-weight-bold">
                <label for="post">Message</label>
                <textarea class="form-control  @error('post') is-invalid @enderror" name="post" id="post" placeholder="Votre post">{{ old('post', $post->post)}}</textarea>
                @error('post')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Modify') }}</button>
        </form>
    </div>
    @endsection
