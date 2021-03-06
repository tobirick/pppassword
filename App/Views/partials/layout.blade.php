<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PPPassword - @yield('title')</title>
    @include('partials.styles')
</head>

<body>
    @if(isset($flash))
        @include('components.flash')
    @endif

    <div class="content-wrapper">
        @include('partials.navigation')
        <div id="content">
            @yield('content')
        </div>
    </div>

    @include('partials.scripts')

</body>

</html>