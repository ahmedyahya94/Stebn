@extends('app')

<style>
    #username{
        text-transform: capitalize;
    }
</style>

@section('content')

<div class="container">

    <h1 id="username"> Hello {{$user->name}}</h1>

    <h1></h1>
    <button class="btn btn-default">
        <a href="/hotelManager/registerReceptionist">Register A Receptionist</a></button>

    @yield('register')
<h1></h1>
    <button class="btn btn-default">
        <a href="../hotelreceptionist/welcome"> Go To Receptionist's View</a>
    </button>
</div>

@endsection