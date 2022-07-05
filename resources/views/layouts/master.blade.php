<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bulk Leads Manager</title>

    @yield('style')
    @include('layouts.partials.header')
</head>
<body>

    <div class="main">

        @if (Auth::check())
        <div class="d-flex">
            @include('layouts.partials.sidebar')
            @include('layouts.partials.navbar')
        </div>
        @endif

        @yield('content')
    </div>

    {{-- @if (Auth::check())
        @include('layouts.partials.footer')
    @endif --}}

    @include('layouts.partials.footerscript')
    @yield('script')

</body>
</html>
