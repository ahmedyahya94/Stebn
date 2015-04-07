@extends('Customer.welcome')
@section('viewRentedBikes')

    @foreach($user as $user)
    <ul>
        <li>
           
           {{ $users->id}}
        </li>
    </ul>

@endforeach