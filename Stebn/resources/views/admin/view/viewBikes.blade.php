@foreach($bikes as $bike)
    <ul>
        <li>
           {{ $bike->type }}
        </li>
    </ul>

@endforeach