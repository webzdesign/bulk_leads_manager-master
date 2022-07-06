<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bulk Leads Manager</title>

    @yield('style')
    @include('layouts.partials.headerscript')
</head>
<body>

    <div class="main">

        @if (Auth::check())
            <div class="d-flex">
                @include('layouts.partials.sidebar')

                <section class="w-100 rightSection">

                    @include('layouts.partials.header')

                    @yield('content')

                    @include('layouts.partials.footer')
                </section>
            </div>
        @endif

        {{-- @yield('content') --}}
    </div>

    {{-- @if (Auth::check())
        @include('layouts.partials.footer')
    @endif --}}

    @include('layouts.partials.footerscript')
    @yield('script')

</body>
</html>
