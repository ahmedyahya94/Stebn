@extends('app')

<style>
    #username{
        text-transform: capitalize;
    }
</style>

@section('content')

<div class="container">

<h1 id="username"> Hello {{$user->name}}</h1>

    <button class="btn btn-default">
        <a href="/admin/cards">Create Cards </a></button>
<h1></h1>
@yield('cards')
<h1></h1>
    <button class="btn btn-default">
        <a href="/admin/registerManager">Create A Manager</a></button>

@yield('registerManager')
<h1></h1>
    <button class="btn btn-default">
        <a href="/admin/bikes">Create Bikes </a></button>
<h1></h1>
@yield('bikes')
    <button class="btn btn-default">
        <a href="/admin/bikestations">Create Bike Stations</a></button>
<h1></h1>
@yield('bikestations')

    <button class="btn btn-default">
        <a href="/admin/viewBikeStations"> View Bike Stations</a>
    </button>

@yield('viewBikeStations')
@yield('viewBikes')

    <h1></h1>
    <button class="btn btn-default">
        <a href="../hotelreceptionist/welcome"> Go To Receptionist's View</a>
    </button>

    <h1></h1>
    <button class="btn btn-default">
        <a href="../hotelManager/welcome"> Go To Manager's View</a>
    </button>

    <h1></h1>
    <button class="btn btn-default">
        <a href="../Customer/welcome"> Go To Customer's View</a>
    </button>
<h1></h1>
    <button class="btn btn-default">
        <a href="/admin/updateMinTime">Update Minimum Time</a></button>

@yield('updateMinTime')

<h1></h1>
    <button class="btn btn-default">
        <a href="/admin/updatePrice">Update Price</a></button>

@yield('updatePrice')

    <h1></h1>
    <button class="btn btn-default">
        <a href="/admin/viewProcesses">View Processes </a></button>

    @yield('viewProcesses')

    <h1></h1>
    <button class="btn btn-default">
        <a href="/admin/viewBikeStationFinance">View Bike Station Finances</a></button>

    @yield('viewBikeStationFinance')


</div>

@endsection