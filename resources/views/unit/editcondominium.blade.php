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
                    <form id="condos" method="POST" action="{{ url('condominium/' . $unit->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="owner">Owner Name</label>
                            <input type="text" class="form-control" name="owner" id="owner"
                                placeholder="{{ $unit->owner }}">
                        </div>
                        <div class="form-group">
                            <label for="unit">Block/Unit Number</label>
                            <input type="text" class="form-control" name="unit" id="unit" placeholder="{{ $unit->unit }}">
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact Number</label>
                            <input type="text" class="form-control" name="contact" id="contact"
                                placeholder="{{ $unit->contact }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>

            </div>
        </div>

    </div>
@endsection
