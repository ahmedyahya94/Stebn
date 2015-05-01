@extends('Customer.welcome')
@section('ResetPassword')

    {!! Form::open(['url' => 'ResetPassword']) !!}

    <div class ="container">

        <div class = "form-group">

            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', $attributes = ['class' => 'form-control', 'placeholder' => 'Please enter your desired password here']) !!}

        </div>

        <div class = "form-group">
            {!! Form::label('password_confirmation', 'Confirm Password:') !!}
            {!! Form::password('password_confirmation', $attributes = ['class' => 'form-control', 'placeholder' => 'Please confirm your password']) !!}
        </div>


        <div class = "form-group">

            {!! Form::submit(null, ['class' => 'btn btn-primary form-control']) !!}

        </div>

        @include('errors/list')

    </div>

@endsection