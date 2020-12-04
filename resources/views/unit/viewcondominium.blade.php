@extends('layouts.mainlayout')
@section('content')
    <div class="container mt-5 pb-5">
        <div class="search-container">
            <div class="mb-5">
                <form action="{{ route('condominium.index') }}" method="GET" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control mr-2" name="term" placeholder="Search" id="term">
                        <span class="input-group-btn">
                            <button class="btn btn-info" type="submit" title="Search">
                                Search
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        @foreach (['danger', 'warning', 'success', 'info'] as $key)
            @if (Session::has($key))
                <div class="alert alert-{{ $key }}">
                    {{ Session::get($key) }}
                </div>
            @endif
        @endforeach
        <h1 class="mb-3">Registered Units</h1>
        <table class="table text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Owner</th>
                    <th scope="col">Unit</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1
                @endphp

                @foreach ($condominium as $condo)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $condo->owner }}</td>
                        <td>{{ $condo->unit }}</td>
                        <td><a type="button" href="{{ URL::to('condominium/' . $condo->id) }}"
                                class="btn btn-success">View</a></td>
                        <td><a type="button" href="{{ URL::to('condominium/' . $condo->id . '/edit') }}"
                                class="btn btn-primary">Update</a></td>
                        <td>

                            <form action="{{ route('condominium.destroy', $condo->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <input class="btn btn-danger" type="submit" value="Delete" />
                            </form>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <a class="btn btn-primary mt-3" href="{{ route('condominium.create') }}">Add New Units</a>
    </div>

@endsection
