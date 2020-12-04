@extends('layouts.mainlayout')
@section('content')
    <div class="container mt-5">
        @foreach (['danger', 'warning', 'success', 'info'] as $key)
            @if (Session::has($key))
                <div class="alert alert-{{ $key }}">
                    {{ Session::get($key) }}
                </div>
            @endif
        @endforeach
        <div class="row">
            <div class="col-6 offset-3">
                <h2 class="text-center">Please enter your personal details below:</h1>
                    <form id="visitor" method="POST" action="{{ route('visitor.store') }}">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Jane">
                        </div>
                        <div class="form-group">
                            <label for="visitor_contact">Contact Number</label>
                            <input type="text" class="form-control" name="contact" id="visitor_contact"
                                placeholder="86920312">
                        </div>
                        <div class="form-group">
                            <label for="nric">Last 3 digit of NRIC</label>
                            <input type="nric" class="form-control" name="nric" id="nric" placeholder="123">
                        </div>
                        <div class="form-group">
                            <label for="visiting_unit">Unit you are visiting</label>
                            <select class="form-control" id="visiting_unit" name="unit">
                                @foreach ($unit as $unit)
                                    <option value="{{ $unit->unit }}">{{ $unit->unit }}</option>
                                @endforeach

                            </select>
                        </div>
                        @csrf
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>

            </div>
        </div>

    </div>
@endsection
