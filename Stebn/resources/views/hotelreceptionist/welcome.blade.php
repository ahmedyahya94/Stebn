@extends('app')

@section('content')

<div class="container">

    <h1> Hello {{$user->name}}</h1>

    <button class="btn btn-default">
        <a href="/authentication/register">Create A New Customer </a></button>
<h1></h1>

    @yield('register')

<h1></h1>
    <button class="btn btn-default">
        <a href="/hotelreceptionist/viewCards">View Cards </a></button>

    @yield('viewCards')

    <h1></h1>
    <button class="btn btn-default">
        <a href="/hotelreceptionist/viewCustomersData">View Customers' Financial Data</a></button>

    @yield('viewCustomersData')

    <h1></h1>

    @yield('viewEachCustomerData')

</div>
@endsection
