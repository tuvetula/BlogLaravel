@extends('base')

@section('title')
    Nouveau post
    @endsection

@section('body')
    <div class="container text-center my-3">
        <h1>Nouveau post</h1>
        <form method="POST" action="{{ route('posts.store') }}">
            @csrf
            <div class="form-group text-left">
                <label for="title" class="font-weight-bold"">Titre</label>
                <input type="text" class="form-control  @error('title') is-invalid @enderror" name="title" id="title" placeholder="Titre" value="{{ old('title') }}">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group text-left">
                <label for="author" class="font-weight-bold">Auteur</label>
                <input type="text" class="form-control  @error('author') is-invalid @enderror" name="author" id="author" placeholder="Auteur" value="{{ old('author', $author)}}">
                @error('author')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group text-left">
                <label for="post" class="font-weight-bold">Message</label>
                <textarea class="form-control  @error('post') is-invalid @enderror" name="post" id="post" placeholder="Votre post">{{ old('post') }}</textarea>
                @error('post')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>

    @endsection
