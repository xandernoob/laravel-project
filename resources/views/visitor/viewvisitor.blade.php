@extends('layouts.mainlayout')
@section('content')
    <div class="container mt-5 pb-5">
        <div class="search-container">
            <div class="mb-5">
                <form action="{{ route('visitor.index') }}" method="GET" role="search">
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
        <h1 class="mb-3">Visitor Log</h1>
        <table class="table text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Visitor</th>
                    <th scope="col">Visiting</th>
                    <th scope="col">Enter At</th>
                    <th scope="col">Exit At</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1
                @endphp

                @foreach ($visitors as $visitor)
                    <tr class="text-center">
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $visitor->name }}</td>
                        @if (!$visitor->deleted_at)
                            <td>{{ $visitor->unit }}</td>
                        @else
                            <td>&nbsp;</td>
                        @endif
                        <td>{{ $visitor->created_at }}</td>
                        @if ($visitor->deleted_at)
                            <td>{{ $visitor->deleted_at }}</td>
                        @else
                            <td>&nbsp;</td>
                        @endif
                        <td><a type="button" href="{{ URL::to('visitor/' . $visitor->id) }}"
                                class="btn btn-success">View</a></td>
                        @if (!$visitor->deleted_at)
                            <td><a type="button" href="{{ URL::to('visitor/' . $visitor->id . '/edit') }}"
                                    class="btn btn-primary">Update</a></td>
                        @else
                            <td>&nbsp;</td>
                        @endif
                        <td>
                            <form action="{{ route('visitor.destroy', $visitor->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <input class="btn btn-danger" type="submit" value="Delete" />
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <a class="btn btn-primary mt-3" href="{{ route('visitor.create') }}">Register Here</a>
    </div>

@endsection
