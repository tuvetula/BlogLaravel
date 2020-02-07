@extends('base')

@section('title')
    Accueil
@endsection

@section('body')

<div class="container text-center min-vh-100">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <h1>Marcant Romain</h1>
    <img src="Pictures/PhotoIdSansFondResize.png" alt="Photo id">
    <p>Marcant Romain, {{ __('the developer you need!') }}</p>
    <div class="container">
        <div class="row justify-content-center" id="LogoLine">
            <a href="https://www.linkedin.com/in/romain-marcant/"><img class="logo mx-3" src="Pictures/LogoLinkedin.png" alt="Logo LinkedIn"></a>
            <a href="https://github.com/tuvetula"><img class="logo mx-3" src="Pictures/LogoGithub.png"></a>
        </div>
        <div class="row my-3 justify-content-center">
            <!-- Trigger the modal with a button -->
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Voir mon cv</button>
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header bg-light">
                            <h4 class="modal-title">Mon cv</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="embed-responsive embed-responsive-4by3">
                                <embed class="embed-responsive-item" src="Files/CV_MARCANT_ROMAIN.pdf">
                            </div>

                        </div>
                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-dark font-weight-bold" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="jumbotron m-0 text-center mh-100">
    <div class="container">
        <div class="row card text-white bg-dark">
            <h2 class="card-header">{{ __('Contact me') }}</h2>
            <div class="card-body">
                <form action="{{ url('contact') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" id="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}">@error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control  @error('first_name') is-invalid @enderror" name="first_name" id="first_name" placeholder="{{__('First_name')}}" value="{{ old('first_name') }}">
                        @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" id="email" placeholder="{{__('E-Mail Address')}}" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea class="form-control  @error('message') is-invalid @enderror" rows="6" name="message" id="message" placeholder="{{__('Message')}}">{{ old('message') }}</textarea>
                        @error('message')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Send') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
