@extends('layouts.mainlayout')
@section('content')
    <div class="container mt-5">
        <h1>Unit {{ $unit->unit }}</h1>
        <div class="mt-3">
            <p><strong>Owner:</strong> {{ $unit->owner }}</p>
            <p><strong>Contact:</strong> {{ $unit->contact }}</p>
            <p><strong>Visitor Name & Contact: </strong>
            <ul class="list-group list-group-flush">
                @foreach ($visitor as $visitor)
                    <li class="list-group-item border-0">
                        Name: {{ $visitor->name }}<br>
                        Contact: {{ $visitor->contact }}
                    </li>
                @endforeach
            </ul>
            </p>
        </div>
    </div>

@endsection
