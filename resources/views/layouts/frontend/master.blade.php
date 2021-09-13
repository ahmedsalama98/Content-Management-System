<!DOCTYPE html>

<html lang="{{ app()->currentLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title' , config('app.name'))</title>
        <meta name="description" content="@yield('description', 'Blog App')">
        <meta name="csrf_token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicons -->
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        {{--  <!-- Google font (font-family: 'Roboto', sans-serif; Poppins ; Satisfy) -->  --}}
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,600i,700,700i,800" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
          {{--  style  --}}

                {{--  <!-- Stylesheets -->  --}}
                <link rel="stylesheet" href="{{asset('layouts/css/bootstrap.min.css')}}">
                <link rel="stylesheet" href=" {{asset('layouts/css/plugins.css')}}">
                <link rel="stylesheet" href=" {{asset('layouts/css/style.css')}}">
                {{--  <!-- Cusom css -->  --}}
                <link rel="stylesheet" href=" {{asset('layouts/css/main.css')}}">

                {{--  <!-- Modernizer js -->  --}}
                <script src=" {{asset('layouts/js/modernizr-3.5.0.min.js')}}"></script>





        @yield('style')
    </head>
    <body>

        <div class="wrapper" id="wrapper">

            @include('layouts.frontend._nav')
            @include('partials.alert-messeges')
            <main>
                @yield('content')
            </main>

            @include('layouts.frontend._footer')


        </div>



{{--  scripts  --}}


        <script src="{{ asset('layouts/js/jquery.min.js') }}" ></script>
        <script src="{{ asset('layouts/js/bootstrap.min.js') }}" ></script>
        <script src="{{ asset('layouts/js/popper.min.js') }}" ></script>
        <script src="{{ asset('layouts/js/plugins.js') }}" ></script>
        <script src="{{ asset('layouts/js/active.js') }}" ></script>
        <script src="{{ asset('layouts/js/app.js') }}" ></script>
        <script type="module" src="{{ asset('layouts/js/custom/module.js') }}"></script>
        <script  type="module" src="{{ asset('layouts/js/custom/main.js') }}" ></script>

        @yield('script')
    </body>
</html>
