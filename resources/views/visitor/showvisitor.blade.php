@extends('layouts.mainlayout')
@section('content')
    <div class="container mt-5 pb-5">
        <h1>Visitor Details</h1>
        <div class="mt-3">
            <p><strong>Name:</strong> {{ $visitor->name }}</p>
            <p><strong>Contact Number:</strong> {{ $visitor->contact }}</p>
            <p><strong>NRIC:</strong> {{ $visitor->nric }}</p>
            @if ($visitor->deleted_at)
                <p><strong>Visited:</strong> {{ $visitor->unit }}</p>
            @else
                <p><strong>Visiting:</strong> {{ $visitor->unit }}</p>
            @endif
            <p><strong>Enter premise at:</strong> {{ $visitor->created_at }}</p>
            <p><strong>Left premise at:</strong> {{ $visitor->deleted_at }}</p>
            @if (!$visitor->deleted_at)

                <form action="{{ route('visitor.softdelete', $visitor->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input class="btn btn-info" type="submit" value="Leave Premise" />
                </form>
            @endif
        </div>
    </div>

@endsection
