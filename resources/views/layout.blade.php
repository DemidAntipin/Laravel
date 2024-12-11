<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@section('title') Default title @show</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>
        @section('header')
            @include('shared.header')
        @show

        <div class="content">
            @yield('content')
        </div>
        
        @section('footer')
            @include('shared.footer')
        @show

        @stack('scripts')
            <script>
                //default script
            </script>
        @show
    </body>
</html>
