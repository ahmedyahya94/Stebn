@extends('app')

@section('content')

    <div class="container">

        <h1> Hello User</h1>

        <button class="btn btn-default">
            <a href="/Customer/RentABike">Rent A Bike </a></button>
        <h1></h1>
        @yield('RentABike')
        
        <button class="btn btn-default">
            <a href="/Customer/ViewRentedBikesAndLocation">View Rented Bikes and Location </a></button>
        <h1></h1>
        @yield('ViewRentedBikesAndLocation')
        
    </div>




@endsection