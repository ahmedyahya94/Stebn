@extends('app')

<style>
    #username{
        text-transform: capitalize;
    }
</style>

@section('content')

<div class="container">

    <h1 id="username"> Hello {{$user->name}}</h1>

</div>

@endsection