@extends('Customer.welcome')

@section('viewCustomerProcesses')
<h1></h1>
<style>
    table, th, td {
        border: 2px solid #adadad;
        border-collapse: collapse;
    }
    th, td {
        padding: 5px;
        text-align: left;
    }

    table tr:nth-child(even){background-color: #ffffff;}
    table tr:nth-child(odd){background-color: steelblue;}
</style>

<table border="1" style="width: 100%">

    <tr>
        <th>ID</th>
        <th>Hotel Name</th>
        <th>Card ID </th>
        <th>Bike </th>
        <th>Station From</th>
        <th>Start Time </th>
        <th>Station To</th>
        <th>End Time</th>
        <th>Time Consumed </th>
        <th>Cost </th>
    </tr>

    @foreach($processes as $process)

    <tr>
        <td>{{$process->id}} </td>
        <td>{{$process->hotel}} </td>
        <td>{{$process->card_id}} </td>
        <td>{{$process->bike_id}} </td>
        <td>{{$process->station_from}} </td>
        <td>{{$process->start_time}} </td>
        <td>{{$process->station_to}} </td>
        <td>{{$process->end_time}} </td>
        <td>{{$process->time_consumed}} </td>
        <td>{{$process->cost}} </td>
    </tr>

    @endforeach
</table>
<h1></h1>

@endsection
