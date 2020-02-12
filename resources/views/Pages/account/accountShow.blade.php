@extends('base')

@section('title')
    {{ __('My account') }}
@endsection

@section('css')

@endsection
@section('body')
    <div class="container my-3">
        @if(session()->has('info'))
            <div class="alert alert-success text-center font-weight-bold">{{session('info')}}</div>
        @endif
        <div class="card">
            <div class="card-header text-center">
                <h3>Informations personnelles</h3>
            </div>
            <div class="card-body row">
                <div class="card-img col-md-3 text-center">
                    @if(!empty($user->avatar))
                        <a id="ModifyAvatar" href="#" title="Modifer">
                            <img src="{{ url('storage/avatarsMiniatures100x100/'.basename($user->avatar))}}" alt="avatar"
                                id="avatar" class="rounded-circle">
                        </a>
                    @else
                        <a id="ModifyAvatar" href="#" title="Ajouter">
                        <img src="{{ url('storage/avatarsMiniatures100x100/add-user96.png') }}" alt="avatar" id="avatar">
                        </a>
                    @endif
                </div>
                <div class="col-md-9">
                    <div class="container row">
                        <label for="nameInfo" class="font-weight-bold">{{ __('Name') }}:</label>
                        <p id="nameInfo" class="ml-1">{{ $user->name }}</p>
                    </div>
                    <div class="container row">
                        <label for="first_nameInfo" class="font-weight-bold">{{ __('First_name') }}:</label>
                        <p class="ml-1" id="first_nameInfo">{{ $user->first_name }}</p>
                    </div>
                    <div class="container row">
                        <label for="emailInfo" class="font-weight-bold">{{ __('E-Mail Address') }}:</label>
                        <p class="ml-1" id="emailInfo">{{ $user->email }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="#" id="Modify" class="btn btn-primary">{{ __('Modify') }}</a>
            </div>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">{{ __('Modify') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form id="formModifyAccount" class="form-horizontal" role="form" method="POST"
                              action="{{  url('/account/'.$user->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{ __('Name') }}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="name" value="{{ $user->name }}"
                                           required>
                                    <small class="text-danger help-block"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{ __('First_name') }}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="first_name"
                                           value="{{ $user->first_name }}">
                                    <small class="text-danger help-block"></small>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Modify') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModalAvatar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">{{ __('Modify') }} Avatar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form id="formModifyAvatar" class="form-horizontal" role="form" method="POST"
                              action="{{  url('/avatar/'.$user->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">Avatar</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control" name="avatar"
                                           accept="image/jpeg , image/png , image/jpg">
                                    <small class="text-danger help-block"></small>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Modify') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card my-3">
            <div class="card-header text-center">
                <h3>Vos posts & commentaires</h3>
            </div>
            @if (!empty($posts[0]))
                @foreach($posts as $post)
                    <div class="card-body">
                        <div class="jumbotron my-1 py-4">
                            <div class="container row justify-content-between p-0">
                                <p><span class="font-weight-bold ">Titre: </span> {{ $post->title }}</p>
                                <p>
                                    <span
                                        class="font-weight-bold ">Date de dernière modification: </span> {{ date_format($post->updated_at , 'd-m-Y à H:i:s') }}
                                </p>
                            </div>
                            <div class="container row justify-content-center py-3 mb-3 bg-light">
                                <p class="m-0"> {{ $post->post }}</p>
                            </div>
                            @foreach($post->comments as $comment)
                                <div class="container row p-0">
                                    <span class="font-weight-bold">Commentaire de {{ $comment->commentable->first_name }}: </span>
                                    <p class="mx-3"> {{ $comment->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center my-3">Aucun post à afficher</p>
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            })
            $('#Modify').click(function () {
                $('#myModal').modal();
            });
            $('#formModifyAccount').submit(function (e) {
                e.preventDefault();

                $('input+small').text('');
                $('input').parent().removeClass('has-error');

                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json"
                })
                    .done(function (data) {
                        console.log(data);
                        $('.alert-success').removeClass('hidden');
                        $('#myModal').modal('hide');
                        $('#nameInfo').text(data.name);
                        $('#first_nameInfo').text(data.first_name);
                    })
                    .fail(function (data) {
                        console.log(data);
                        if (data.status == 422) {
                            $.each(data.responseJSON.errors, function (i, error) {
                                $('form')
                                    .find('[name="' + i + '"]')
                                    .addClass('input-invalid')
                                    .next()
                                    .append(error[0]);
                            });
                        }
                    });
            });

        })
        $(function () {
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            })
            $('#ModifyAvatar').click(function () {
                $('#myModalAvatar').modal();
            });

            $('#formModifyAvatar').submit(function (e) {
                e.preventDefault();

                $('input+small').text('');
                $('input').parent().removeClass('has-error');

                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false,
                })
                    .done(function (data) {
                        console.log(data);
                        let name = data;
                        $('.alert-success').removeClass('hidden');
                        $('#myModalAvatar').modal('hide');
                        $('#avatar').attr('src' , 'http://localhost:8000/storage/avatarsMiniatures100x100/' + basename(name));
                    })
                    .fail(function (data) {
                        console.log(data);
                        if (data.status == 422) {
                            $.each(data.responseJSON.errors, function (i, error) {
                                $('form')
                                    .find('[name="' + i + '"]')
                                    .addClass('input-invalid')
                                    .next()
                                    .append(error[0]);
                            });
                        }
                    });
            });

        })
        function basename(path) {
            return path.replace(/.*\//, '');
        }
    </script>
@endsection
