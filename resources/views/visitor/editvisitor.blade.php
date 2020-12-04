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
                <h2 class="text-center">Update your personal details:</h1>
                    <form id="visitor" method="POST" action="{{ url('visitor/' . $visitor->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name"  placeholder="{{ $visitor->name }}">
                        </div>
                        <div class="form-group">
                            <label for="visitor_contact">Contact Number</label>
                            <input type="text" class="form-control" name="contact" id="visitor_contact"
                                placeholder="{{ $visitor->contact }}">
                        </div>
                        <div class="form-group">
                            <label for="nric">Last 3 digit of NRIC</label>
                            <input type="nric" class="form-control" name="nric" id="nric" placeholder="{{ $visitor->nric }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="visiting_unit">Unit you are visiting</label>
                            <select class="form-control" id="visiting_unit" name="unit">
                                @foreach ($unit as $unit)
                                    <option value="{{ $unit->unit }}">{{ $unit->unit }}</option>
                                @endforeach

                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>

            </div>
        </div>

    </div>
@endsection


