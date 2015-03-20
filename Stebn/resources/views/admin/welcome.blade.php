@extends('app')

@section('content')

<div class="container">

<h1> Hello Admin </h1>

<button class="btn btn-default">
    <a href="/admin/cards">Create Cards </a></button>

@yield('cards')

</div>

@endsection