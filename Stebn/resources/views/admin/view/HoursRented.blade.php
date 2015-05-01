@extends('admin.welcome')
@section('ViewHoursRented')

    <h1></h1>
    <h1></h1>
    {!! Form::open(['url' => 'ViewHoursRented']) !!}

    <div class ="container">

        <div class = "form-group"">
        {!! Form::label('start_time', 'Start time:') !!}
        {!! Form::input('date', 'date', null, $attributes = ['class' => 'form-control', 'placeholder' => 'Date']) !!}
    </div>

    <div class = "form-group"">
    {!! Form::label('end_time', 'End time:') !!}
    {!! Form::input('date', 'date', null, $attributes = ['class' => 'form-control', 'placeholder' => 'Date']) !!}
    </div>

    <div class = "form-group">

        {!! Form::submit(null, ['class' => 'btn btn-primary form-control']) !!}

    </div>

    @include('errors/list')

@endsection
