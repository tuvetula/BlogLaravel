@extends('base')

@section('title')
    Accueil
@endsection

@section('body')
<div class="container text-center">
    <h1>Marcant Romain</h1>
    <img src="Pictures/PhotoidSansFond.png" alt="Photo id">
    <p>Marcant Romain, le développeur qu'il vous faut!</p>
</div>
    <div class="jumbotron m-0 text-center">
        <h2>Me contacter</h2>
        <div class="container">
            {!! Form::open(['url' => 'contact']) !!}
            <div class="row">
                <div class="col-md-6">
                    {!! Form::label('nom','Entrez votre nom: ', ['class' => 'font-weight-bold']) !!}
                    {!! Form::text('nom') !!}
                </div>
               <div class="col-md-6">
                   {!! Form::label('prenom', 'Entrez votre prenom: ', ['class' => 'font-weight-bold']) !!}
                   {!! Form::text('prenom') !!}
               </div>
            </div>
            <div class="row">
                {!! Form::label('email','Entrez votre email: ', ['class' => 'text-center font-weight-bold']) !!}
                {!! Form::email('email') !!}
            </div>
            <div class="row">
                {!! Form::label('message', 'Entrez votre message: ', ['class' => 'font-weight-bold']) !!}
                {!! Form::text('message') !!}
            </div>
            <div class="row">
                {!! Form::submit('Envoyer') !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
