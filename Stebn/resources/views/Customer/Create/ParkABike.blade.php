@extends('Customer.welcome')
@section('ParkABike')

<h1></h1>
<h1></h1>
{!! Form::open(['url' => 'ParkABike']) !!}

<div class ="container">



    <div class = "form-group"">
    {!! Form::label('bike_station_id', 'Bike Station ID:') !!}
    {!! Form::text('bike_station_id', null, ['class' => 'form-control']) !!}
</div>

<div class = "form-group"">
{!! Form::label('bike_id', 'Bike ID:') !!}
{!! Form::text('bike_id', null, ['class' => 'form-control']) !!}
</div>

<div class = "form-group"">
{!! Form::label('card_id', 'Card ID:') !!}
{!! Form::text('card_id', null, ['class' => 'form-control']) !!}
</div>



<div class = "form-group">

    {!! Form::submit(null, ['class' => 'btn btn-primary form-control']) !!}

</div>

@include('errors/list')

</div>

@endsection