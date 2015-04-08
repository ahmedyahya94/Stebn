@extends('Customer.welcome')
@section('ViewRentedBikesAndLocation')

    {!! Form::open(['url' => 'ViewRentedBikesAndLocation']) !!}

    <div class ="container">

        <div class = "form-group"">
        {!! Form::label('bike_id', ' Bike ID') !!}
        {!! Form::select('bike_id', $renting->lists('bike_id'), null, ['class' => 'form-control']) !!}
    </div>
    <div class = "form-group"">
        {!! Form::label('bike_station_id', 'Bike Station ID') !!}
        {!! Form::select('bike_station_id', $renting->lists('bike_station_id'), null, ['class' => 'form-control']) !!}
    </div>

    @include('errors/list')

    </div>

@endsection