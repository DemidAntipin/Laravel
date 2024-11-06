<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@section('title') Default title @show</title>
        <style>
            body {
                background-color: #dddddd;
            }
            header {
                position: sticky;
                width: 100%;
                background-color: #312434;
                padding: 10px 20px;
            }
            .content {
                border: 1px solid blue;
                border-radius: 20px;
                padding: 10px;
                margin-top: 30px;
            }
            footer {
                margin-top: 20px;
            }
            a {
                color: default;
            }
        </style>
	@section('css')
		@yield('css')
	@show
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
