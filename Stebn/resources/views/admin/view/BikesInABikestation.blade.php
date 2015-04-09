@extends('admin.welcome')
@section('ViewBikesInACertainStation')

    {!! Form::open(['url' => 'ViewBikesInACertainStation']) !!}

    <div class ="container">
        <div class = "form-group"">
        {!! Form::label('station', ' ') !!}
        {!! Form::select('station', $bikestations->lists('location'), null, ['class' => 'form-control']) !!}
    </div>

    <div class = "form-group">
        {!! Form::submit(null, ['class' => 'btn btn-primary form-control']) !!}
    </div>

    @include('errors/list')

    </div>

@endsection