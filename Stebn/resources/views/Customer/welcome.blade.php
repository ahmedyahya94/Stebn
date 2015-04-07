@extends('app')

@section('content')

    <div class="container">

        <h1> Hello User</h1>

        <button class="btn btn-default">
            <a href="/Customer/RentABike">Rent A Bike </a></button>
        <h1></h1>
        @yield('RentABike')
        <button class="btn btn-default">
            <a href="/Customer/ViewRentedBikes">View Rented Bikes </a></button>
        <h1></h1>
        @yield('ViewRentedBikes')
    </div>




@endsection