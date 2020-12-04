@extends('layouts.mainlayout')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-6 offset-3">
                <h2 class="text-center">Please enter your details:</h1>
                    <form id="condos" method="POST" action="{{ route('condominium.store') }}">
                        <div class="form-group">
                            <label for="owner">Owner Name</label>
                            <input type="text" class="form-control" name="owner" id="owner" placeholder="John">
                        </div>
                        <div class="form-group">
                            <label for="unit">Block/Unit Number</label>
                            <input type="text" class="form-control" name="unit" id="unit" placeholder="12A">
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact Number</label>
                            <input type="text" class="form-control" name="contact" id="contact" placeholder="86920312">
                        </div>
                        @csrf
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>

            </div>
        </div>

    </div>
@endsection
