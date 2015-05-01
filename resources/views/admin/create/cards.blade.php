@extends('admin.welcome')
@section('cards')

<h1></h1>
<h1></h1>
{!! Form::open(['url' => 'CreateCards']) !!}

<div class ="container">

    <div class = "form-group"">
        {!! Form::label('number', 'How many cards do you wish to create?') !!}
        {!! Form::text('number', null, $attributes = ['class' => 'form-control', 'placeholder' => 'Please enter the desired number of cards to be created here']) !!}
    </div>

    <div class = "form-group">

        {!! Form::submit(null, ['class' => 'btn btn-primary form-control']) !!}

    </div>

@include('errors/list')

</div>

@endsection