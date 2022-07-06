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

                    <div class="breadcrumb">
                        <ul class="p-0 m-0 w-100">
                            <li>
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.99996 0L11.3333 4V12H7.99996V7.33333H3.99996V12H0.666626V4L5.99996 0Z" fill="#7B809A"/>
                                </svg>
                            </li>
                            <li>
                                <a href="javascript:;" class="f-14 f-400 c-7b">Home</a>
                            </li>
                            <li class="f-14 f-400 c-7b">
                                /
                            </li>
                            <li class="f-14 f-400 c-36">{{ isset($moduleName) && $moduleName !=null ? $moduleName : '' }}</li>
                        </ul>
                        <h2 class="f-24 f-700 c-36 mt-3">{{ isset($moduleName) && $moduleName !=null ? $moduleName : '' }}</h2>
                        <div class="devider"></div>
                    </div>

                    @yield('content')

                    @include('layouts.partials.footer')
                </section>
            </div>
            @else
                @yield('content')
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
