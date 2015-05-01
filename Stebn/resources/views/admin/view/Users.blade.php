@extends('admin.welcome')

@section('Users')

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
            <th>Name</th>
            <th>Card ID </th>
            <th>Type </th>
            <th>Location</th>
            
        </tr>

        @foreach($users as $user)
        
        <tr>
            <td>{{$user->id}} </td>
            <td>{{$user->name}} </td>
            <td>{{$user->card_id}} </td>
            <td><?php if($user->type == 0){ 
            	echo "Customer"; 
            }else if($user->type == 1){
            	echo 'Admin';
            }else if($user->type == 2){
            	echo 'Hotel Receptionist';
            }else if($user->type == 3){
            	echo 'Hotel Manager';
            }?></td>
            <td>{{$user->location}} </td>
        </tr>
      
        @endforeach
    
    </table>

<h1></h1>

@endsection

