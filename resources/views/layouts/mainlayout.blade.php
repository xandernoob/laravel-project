<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('layouts.partials.head')
</head>

<body>
    @include('layouts.partials.nav')
    @yield('content')
    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')
</body>

</html>
