@extends('base')

@section('title')
    Accueil
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row align-items-center justify-content-center min-vh-100">
            <div class="col-md-8 text-center">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <h1>Marcant Romain</h1>
                <img src="Pictures/PhotoIdSansFondResize.png" alt="Photo id" class="rounded-pill bg-warning">
                <p>Marcant Romain, {{ __('the developer you need!') }}</p>
                <div class="container">
                    <div class="row justify-content-center" id="LogoLine">
                        <a href="https://www.linkedin.com/in/romain-marcant/"><img class="logo mx-3"
                                                                                   src="Pictures/LogoLinkedin.png"
                                                                                   alt="Logo LinkedIn"></a>
                        <a href="https://github.com/tuvetula"><img class="logo mx-3" src="Pictures/LogoGithub.png"></a>
                    </div>
                    <div class="row my-3 justify-content-center">
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                            Voir
                            mon cv
                        </button>
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
                                        <button type="button" class="btn btn-dark font-weight-bold"
                                                data-dismiss="modal">
                                            {{ __('Close') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('Pages.contact.includeContactForm');
@endsection
