<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('web.layout.head')
<body>
@yield('content')
</body>
</html>
